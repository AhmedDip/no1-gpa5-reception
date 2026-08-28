<?php
// app/Services/AuditReportService.php

namespace App\Services;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AuditReportService
{
    private const UPLOADS_BASE_URL = 'https://no1family.com/uploads/';

    public function __construct(private OrgHierarchyService $orgHierarchy)
    {
    }

    /**
     * Base query for RM-approved audit rows (action = rm_approve).
     *
     * Every join here is a plain belongsTo-style FK join (t1 -> t2 -> t4/t5/t6/t7/t8/t9/t10/t12),
     * so each application_audit_logs row produces exactly one result row.
     * Wing/Region/Territory are intentionally NOT joined here — they are
     * resolved afterwards via OrgHierarchyService::resolveForUpazilas(),
     * the same pattern used by ApplicationController / ApplicationExportService.
     * (Previously this joined tm_wing/tm_zone directly; since tm_wing.aemp_id
     * is not unique, that join multiplied rows and produced duplicates.)
     */
    public function rmApprovedQuery(array $filters): Builder
    {
        $query = DB::table('application_audit_logs as t1')
            ->join('student_details as t2', 't1.student_detail_id', '=', 't2.id')
            ->join('boards as t4', 't2.ssc_board_id', '=', 't4.id')
            ->join('student_groups as t5', 't2.student_group_id', '=', 't5.id')
            ->join('users as t12', 't2.user_id', '=', 't12.id')
            ->join('divisions as t6', 't2.division_id', '=', 't6.id')
            ->join('districts as t7', 't2.district_id', '=', 't7.id')
            ->join('upazilas as t8', 't2.upazila_id', '=', 't8.id')
            ->join('application_statuses as t9', 't2.application_status_id', '=', 't9.id')
            ->join('users as t10', 't2.rm_reviewed_by', '=', 't10.id')
            ->where('t1.action', 'rm_approve')
            ->where('t10.lfcl_id', 1)
            ->where('t12.lfcl_id', 1);

        $this->applyCommonFilters($query, $filters);

        return $query;
    }

    /**
     * Base query for WM-approved audit rows (action = wm_approve).
     * See rmApprovedQuery() docblock — same no-duplicate-join principle applies.
     */
    public function wmApprovedQuery(array $filters): Builder
    {
        $query = DB::table('application_audit_logs as t1')
            ->join('student_details as t2', 't1.student_detail_id', '=', 't2.id')
            ->join('boards as t4', 't2.ssc_board_id', '=', 't4.id')
            ->join('student_groups as t5', 't2.student_group_id', '=', 't5.id')
            ->join('users as t12', 't2.user_id', '=', 't12.id')
            ->join('divisions as t6', 't2.division_id', '=', 't6.id')
            ->join('districts as t7', 't2.district_id', '=', 't7.id')
            ->join('upazilas as t8', 't2.upazila_id', '=', 't8.id')
            ->join('application_statuses as t9', 't2.application_status_id', '=', 't9.id')
            ->join('users as t10', 't2.wm_reviewed_by', '=', 't10.id')
            ->where('t1.action', 'wm_approve')
            ->where('t10.lfcl_id', 1)
            ->where('t12.lfcl_id', 1);

        $this->applyCommonFilters($query, $filters);

        return $query;
    }

    /**
     * Shared filters for both reports.
     */
    private function applyCommonFilters(Builder $query, array $filters): void
    {
        if (!empty($filters['date_from'])) {
            $query->whereDate('t1.created_at', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('t1.created_at', '<=', $filters['date_to']);
        }

        if (!empty($filters['board'])) {
            $query->where('t2.ssc_board_id', $filters['board']);
        }

        if (!empty($filters['division'])) {
            $query->where('t2.division_id', $filters['division']);
        }

        if (!empty($filters['search'])) {
            $s = $filters['search'];
            $query->where(function (Builder $q) use ($s) {
                $q->where('t2.name_en', 'LIKE', "%{$s}%")
                    ->orWhere('t2.name_bn', 'LIKE', "%{$s}%")
                    ->orWhere('t2.roll_number', 'LIKE', "%{$s}%")
                    ->orWhere('t2.registration_number', 'LIKE', "%{$s}%")
                    ->orWhere('t12.mobile', 'LIKE', "%{$s}%");
            });
        }
    }

    /**
     * Columns shown on-screen. Includes t2.upazila_id so the controller can
     * resolve Wing/Region/Territory via OrgHierarchyService after fetching.
     */
    public function selectListColumns(Builder $query, string $type): Builder
    {
        return $query->select([
            't2.upazila_id',
            't2.name_en as student_name',
            't2.name_bn as student_name_bangla',
            't2.roll_number',
            't2.registration_number',
            't2.gpa_result',
            DB::raw("CONCAT('" . self::UPLOADS_BASE_URL . "', t2.student_photo) as student_photo"),
            't2.father_name',
            't2.mother_name',
            't2.tea_stall_name',
            't2.tea_stall_location',
            't2.parent_mobile',
            DB::raw("CONCAT('" . self::UPLOADS_BASE_URL . "', t2.parent_photo) as parent_photo"),
            't1.ip_address',
            't1.created_at as approved_at',
            't4.name as board_name',
            't4.name_bn as board_name_bn',
            't5.name as group_name',
            't5.name_bn as group_name_bn',
            't6.name as division_name',
            't6.name_bn as division_name_bn',
            't7.name as district_name',
            't7.name_bn as district_name_bn',
            't8.name as upazila_name',
            't8.name_bn as upazila_name_bn',
            't10.email as staff_id',
            't10.name as staff_name',
            't12.mobile as user_mobile',
            't12.name as user_name',
            't1.remarks',
        ]);
    }

    /**
     * Resolve Wing/Region/Territory for a paginated/collected result set,
     * keyed by upazila_id — mirrors ApplicationController::index().
     *
     * @param  iterable  $records  Rows containing an `upazila_id` property.
     * @return array<int, array{wing: ?string, region: ?string, territory: ?string}>
     */
    public function resolveOrgHierarchy(iterable $records): array
    {
        $upazilaIds = collect($records)->pluck('upazila_id')->filter()->unique()->values()->all();

        return $this->orgHierarchy->resolveForUpazilas($upazilaIds);
    }

    public function downloadCsv(array $filters, string $type): StreamedResponse
    {
        $baseQuery = $type === 'rm' ? $this->rmApprovedQuery($filters) : $this->wmApprovedQuery($filters);

        // Resolve Wing/Region/Territory once for every upazila in the result
        // set (same pattern as ApplicationExportService::downloadCsv), instead
        // of joining tm_wing/tm_zone directly, which previously duplicated rows.
        $distinctUpazilaIds = (clone $baseQuery)
            ->whereNotNull('t2.upazila_id')
            ->select('t2.upazila_id as upazila_id')
            ->distinct()
            ->pluck('upazila_id')
            ->all();

        $orgHierarchy = $this->orgHierarchy->resolveForUpazilas($distinctUpazilaIds);

        $staffLabel = $type === 'rm' ? 'RM' : 'WM';

        $query = $baseQuery->select([
            't2.upazila_id',
            't2.name_en as STUDENT_NAME',
            't2.name_bn as STUDENT_NAME_BANGLA',
            't2.roll_number as ROLL_NUMBER',
            't2.registration_number as REGISTRATION_NUMBER',
            't2.gpa_result as GPA_RESULT',
            DB::raw("CONCAT('" . self::UPLOADS_BASE_URL . "', t2.student_photo) as STUDENT_PHOTO"),
            't2.father_name as FATHER_NAME',
            't2.mother_name as MOTHER_NAME',
            't2.tea_stall_name as TEA_STALL_NAME',
            't2.tea_stall_location as TEA_STALL_LOCATION',
            't2.parent_mobile as PARENT_MOBILE',
            DB::raw("CONCAT('" . self::UPLOADS_BASE_URL . "', t2.parent_photo) as PARENT_PHOTO"),
            't1.ip_address as IP_ADDRESS',
            't1.created_at as CREATED_AT',
            't4.name as BOARD_NAME',
            't4.name_bn as BOARD_NAME_BN',
            't5.name as GROUP_NAME',
            't5.name_bn as GROUP_NAME_BN',
            't6.name as DIVISION_NAME',
            't6.name_bn as DIVISION_NAME_BN',
            't7.name as DISTRICT_NAME',
            't7.name_bn as DISTRICT_NAME_BN',
            't8.name as UPAZILA_NAME',
            't8.name_bn as UPAZILA_NAME_BN',
            DB::raw("t10.email as {$staffLabel}_STAFF_ID"),
            DB::raw("t10.name as {$staffLabel}_STAFF_NAME"),
            't12.mobile as USER_MOBILE',
            't12.name as USER_NAME',
            't1.remarks as REMARKS',
        ])->orderBy('t1.created_at', 'desc');

        $fileName = ($type === 'rm' ? 'rm_approved_' : 'wm_approved_') . now()->format('Y_m_d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return new StreamedResponse(function () use ($query, $staffLabel, $orgHierarchy) {
            $handle = fopen('php://output', 'w');

            if ($handle === false) {
                Log::error('AuditReportService: failed to open output stream for CSV export.');
                return;
            }

            // UTF-8 BOM so Excel opens Bangla text correctly
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($handle, [
                'TERRITORY',
                'REGION',
                'WING',
                'STUDENT_NAME',
                'STUDENT_NAME_BANGLA',
                'ROLL_NUMBER',
                'REGISTRATION_NUMBER',
                'GPA_RESULT',
                'STUDENT_PHOTO',
                'FATHER_NAME',
                'MOTHER_NAME',
                'TEA_STALL_NAME',
                'TEA_STALL_LOCATION',
                'PARENT_MOBILE',
                'PARENT_PHOTO',
                'IP_ADDRESS',
                'CREATED_AT',
                'BOARD_NAME',
                'BOARD_NAME_BN',
                'GROUP_NAME',
                'GROUP_NAME_BN',
                'DIVISION_NAME',
                'DIVISION_NAME_BN',
                'DISTRICT_NAME',
                'DISTRICT_NAME_BN',
                'UPAZILA_NAME',
                'UPAZILA_NAME_BN',
                "{$staffLabel}_STAFF_ID",
                "{$staffLabel}_STAFF_NAME",
                'USER_MOBILE',
                'USER_NAME',
                'REMARKS',
            ]);

            try {
                $query->chunk(500, function ($rows) use ($handle, $orgHierarchy) {
                    foreach ($rows as $row) {
                        $org = $orgHierarchy[$row->upazila_id] ?? null;

                        fputcsv($handle, [
                            $org['territory'] ?? '',
                            $org['region'] ?? '',
                            $org['wing'] ?? '',
                            $row->STUDENT_NAME,
                            $row->STUDENT_NAME_BANGLA,
                            $row->ROLL_NUMBER,
                            $row->REGISTRATION_NUMBER,
                            $row->GPA_RESULT,
                            $row->STUDENT_PHOTO,
                            $row->FATHER_NAME,
                            $row->MOTHER_NAME,
                            $row->TEA_STALL_NAME,
                            $row->TEA_STALL_LOCATION,
                            $row->PARENT_MOBILE,
                            $row->PARENT_PHOTO,
                            $row->IP_ADDRESS,
                            $row->CREATED_AT,
                            $row->BOARD_NAME,
                            $row->BOARD_NAME_BN,
                            $row->GROUP_NAME,
                            $row->GROUP_NAME_BN,
                            $row->DIVISION_NAME,
                            $row->DIVISION_NAME_BN,
                            $row->DISTRICT_NAME,
                            $row->DISTRICT_NAME_BN,
                            $row->UPAZILA_NAME,
                            $row->UPAZILA_NAME_BN,
                            $row->{"{$staffLabel}_STAFF_ID"},
                            $row->{"{$staffLabel}_STAFF_NAME"},
                            $row->USER_MOBILE,
                            $row->USER_NAME,
                            $row->REMARKS,
                        ]);
                    }
                });
            } catch (\Throwable $e) {
                Log::error('AuditReportService: CSV export failed mid-stream: ' . $e->getMessage());
            }

            fclose($handle);
        }, 200, $headers);
    }
}
