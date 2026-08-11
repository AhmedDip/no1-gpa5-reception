<?php
// app/Services/ApplicationExportService.php

namespace App\Services;

use App\Models\StudentDetail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ApplicationExportService
{
    public function __construct(private OrgHierarchyService $orgHierarchy)
    {
    }

    /**
     * Build a filtered query with eager-loaded relations.
     *
     * @param array         $filters    status, board, division, district, search
     * @param array|null    $upazilaIds Optional RM/WM scope restriction (null = unrestricted/admin)
     */
    public function buildQuery(array $filters, ?array $upazilaIds = null): Builder
    {
        $query = StudentDetail::with([
            'user',
            'board',
            'group',
            'division',
            'district',
            'upazila',
            'applicationStatus',
            'rmReviewer',
            'wmReviewer',
        ]);

        $query->whereHas('user', function (Builder $q) {
            $q->where('lfcl_id', 1);
        });

        $this->applyFilters($query, $filters);

        if ($upazilaIds !== null) {
            $query->whereIn('upazila_id', $upazilaIds);
        }

        return $query;
    }

    /**
     * Apply the shared set of list/export filters to a query builder.
     */
    private function applyFilters(Builder $query, array $filters): void
    {
        if (!empty($filters['status'])) {
            $query->where('application_status_id', $filters['status']);
        }

        if (!empty($filters['board'])) {
            $query->where('ssc_board_id', $filters['board']);
        }

        if (!empty($filters['division'])) {
            $query->where('division_id', $filters['division']);
        }

        if (!empty($filters['district'])) {
            $query->where('district_id', $filters['district']);
        }

        if (!empty($filters['search'])) {
            $s = $filters['search'];
            $query->where(function (Builder $q) use ($s) {
                $q->where('name_en', 'LIKE', "%{$s}%")
                    ->orWhere('name_bn', 'LIKE', "%{$s}%")
                    ->orWhere('roll_number', 'LIKE', "%{$s}%")
                    ->orWhere('registration_number', 'LIKE', "%{$s}%")
                    ->orWhere('father_name', 'LIKE', "%{$s}%")
                    ->orWhere('tea_stall_name', 'LIKE', "%{$s}%");
            });
        }
    }

    /**
     * Stream a CSV download of the filtered applications, including
     * Wing / Region / Territory (resolved via OrgHierarchyService) so the
     * export mirrors exactly what the admin sees in the applications table.
     */
    public function downloadCsv(array $filters, ?array $upazilaIds = null): StreamedResponse
    {
        $fileName = 'applications_' . now()->format('Y_m_d_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        // Resolve Wing/Region/Territory once for every upazila in the result
        // set, so we never hit the resolver per-row inside the chunk loop.
        $baseQuery       = $this->buildQuery($filters, $upazilaIds);
        $distinctUpazilaIds = (clone $baseQuery)
            ->whereNotNull('upazila_id')
            ->select('upazila_id')
            ->distinct()
            ->pluck('upazila_id')
            ->all();

        $orgHierarchy = $this->orgHierarchy->resolveForUpazilas($distinctUpazilaIds);

        $exportQuery = $this->buildQuery($filters, $upazilaIds)
            ->withCount('smsLogs')
            ->orderBy('created_at', 'desc');

        $response = new StreamedResponse(function () use ($exportQuery, $orgHierarchy) {
            $handle = fopen('php://output', 'w');

            if ($handle === false) {
                Log::error('ApplicationExportService: failed to open output stream for CSV export.');
                return;
            }

            // UTF-8 BOM so Excel opens Bangla text correctly
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($handle, [
                'SL',
                'Wing',
                'Region',
                'Territory',
                'Name (EN)',
                'Name (BN)',
                'Mobile',
                'Email',
                'Board',
                'Group',
                'Roll No',
                'Registration No',
                'GPA/Result',
                'Student Photo URL',
                'Division',
                'District',
                'Upazila',
                'Father Name',
                'Mother Name',
                'Tea Stall Name',
                'Tea Stall Location',
                'Parent Mobile',
                'Status',
                'RM Reviewed By',
                'RM Reviewed At',
                'WM Reviewed By',
                'WM Reviewed At',
                'SMS Sent Count',
                'Submitted At',
            ]);

            $sl = 1;

            try {
                $exportQuery->chunk(500, function ($records) use ($handle, &$sl, $orgHierarchy) {
                    foreach ($records as $app) {
                        $org = $orgHierarchy[$app->upazila_id] ?? null;

                        fputcsv($handle, [
                            $sl++,
                            $org['wing'] ?? '',
                            $org['region'] ?? '',
                            $org['territory'] ?? '',
                            $app->name_en,
                            $app->name_bn,
                            $app->user->mobile ?? '',
                            $app->user->email ?? '',
                            $app->board->name ?? '',
                            $app->group->name ?? '',
                            $app->roll_number,
                            $app->registration_number,
                            $app->gpa_result,
                            $app->student_photo_url,
                            $app->division->name ?? '',
                            $app->district->name ?? '',
                            $app->upazila->name ?? '',
                            $app->father_name,
                            $app->mother_name,
                            $app->tea_stall_name,
                            $app->tea_stall_location,
                            $app->parent_mobile,
                            $app->applicationStatus->name ?? 'Pending',
                            $app->rmReviewer->name ?? '',
                            $app->rm_reviewed_at ? $app->rm_reviewed_at->format('Y-m-d H:i') : '',
                            $app->wmReviewer->name ?? '',
                            $app->wm_reviewed_at ? $app->wm_reviewed_at->format('Y-m-d H:i') : '',
                            $app->sms_logs_count ?? 0,
                            $app->created_at ? $app->created_at->format('Y-m-d H:i') : '',
                        ]);
                    }
                });
            } catch (\Throwable $e) {
                Log::error('ApplicationExportService: CSV export failed mid-stream: ' . $e->getMessage());
            }

            fclose($handle);
        }, 200, $headers);

        return $response;
    }
}