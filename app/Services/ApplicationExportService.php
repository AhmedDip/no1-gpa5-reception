<?php
// app/Services/ApplicationExportService.php

namespace App\Services;

use App\Models\StudentDetail;
use Illuminate\Support\Collection;

class ApplicationExportService
{
    /**
     * Build a filtered query and return as Collection with eager-loaded relations
     */
    public function buildQuery(array $filters): \Illuminate\Database\Eloquent\Builder
    {
        $query = StudentDetail::with([
            'user',
            'board',
            'group',
            'division',
            'district',
            'upazila',
            'applicationStatus',
        ]);

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
            $query->where(function ($q) use ($s) {
                $q->where('name_en', 'LIKE', "%{$s}%")
                    ->orWhere('name_bn', 'LIKE', "%{$s}%")
                    ->orWhere('roll_number', 'LIKE', "%{$s}%")
                    ->orWhere('registration_number', 'LIKE', "%{$s}%")
                    ->orWhere('father_name', 'LIKE', "%{$s}%")
                    ->orWhere('tea_stall_name', 'LIKE', "%{$s}%");
            });
        }

        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Stream CSV download response
     */
    public function downloadCsv(array $filters): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $fileName = 'applications_' . now()->format('Y_m_d_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $response = new \Symfony\Component\HttpFoundation\StreamedResponse(function () use ($filters) {
            $handle = fopen('php://output', 'w');

            // UTF-8 BOM so Excel opens correctly
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header row
            fputcsv($handle, [
                'SL',
                'Name (EN)',
                'Name (BN)',
                'Mobile',
                'Email',
                'Board',
                'Group',
                'Roll No',
                'Registration No',
                'GPA/Result',
                'Division',
                'District',
                'Upazila',
                'Father Name',
                'Mother Name',
                'Tea Stall Name',
                'Tea Stall Location',
                'Parent Mobile',
                'Status',
                'SMS Sent',
                'Submitted At',
            ]);

            $query = $this->buildQuery($filters);
            $sl    = 1;

            $query->chunk(500, function ($records) use ($handle, &$sl) {
                foreach ($records as $app) {
                    fputcsv($handle, [
                        $sl++,
                        $app->name_en,
                        $app->name_bn,
                        $app->user->mobile ?? '',
                        $app->user->email ?? '',
                        $app->board->name ?? '',
                        $app->group->name ?? '',
                        $app->roll_number,
                        $app->registration_number,
                        $app->gpa_result,
                        $app->division->name ?? '',
                        $app->district->name ?? '',
                        $app->upazila->name ?? '',
                        $app->father_name,
                        $app->mother_name,
                        $app->tea_stall_name,
                        $app->tea_stall_location,
                        $app->parent_mobile,
                        $app->applicationStatus->name ?? 'Pending',
                        $app->notification_sent ? 'Yes' : 'No',
                        $app->created_at ? $app->created_at->format('Y-m-d H:i') : '',
                    ]);
                }
            });

            fclose($handle);
        }, 200, $headers);

        return $response;
    }
}
