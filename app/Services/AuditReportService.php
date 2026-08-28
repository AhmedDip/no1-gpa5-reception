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

    /**
     * Base query for RM-approved audit rows (action = rm_approve).
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
            ->leftJoin('tm_zone as t11', 't10.zone_id', '=', 't11.id')
            ->where('t1.action', 'rm_approve')
            ->where('t10.lfcl_id', 1)
            ->where('t12.lfcl_id', 1);

        $this->applyCommonFilters($query, $filters);

        // Group by all non-aggregated columns to avoid ONLY_FULL_GROUP_BY error
        $query->groupBy(
            't12.mobile',
            't11.zone_name',
            't11.dirg_id',
            't10.aemp_mngr',
            't1.ip_address',
            't1.remarks',
            't1.created_at',
            't2.name_en',
            't2.name_bn',
            't2.roll_number',
            't2.registration_number',
            't2.gpa_result',
            't2.student_photo',
            't2.father_name',
            't2.mother_name',
            't2.tea_stall_name',
            't2.tea_stall_location',
            't2.parent_mobile',
            't2.parent_photo',
            't4.name',
            't4.name_bn',
            't5.name',
            't5.name_bn',
            't6.name',
            't6.name_bn',
            't7.name',
            't7.name_bn',
            't8.name',
            't8.name_bn',
            't10.email',
            't10.name',
            't12.name'
        );

        return $query;
    }

    /**
     * Base query for WM-approved audit rows (action = wm_approve).
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
            ->leftJoin('tm_zone as t11', 't10.zone_id', '=', 't11.id')
            ->leftJoin('tm_wing as t13', 't10.aemp_mngr', '=', 't13.aemp_id')
            ->leftJoin('tm_wing as t14', 't10.id', '=', 't14.aemp_id')
            ->where('t1.action', 'wm_approve')
            ->where('t10.lfcl_id', 1)
            ->where('t12.lfcl_id', 1);

        $this->applyCommonFilters($query, $filters);

        // Group by all non-aggregated columns to avoid ONLY_FULL_GROUP_BY error
        $query->groupBy(
            't12.mobile',
            't11.zone_name',
            't11.dirg_id',
            't10.aemp_mngr',
            't1.ip_address',
            't1.remarks',
            't1.created_at',
            't2.name_en',
            't2.name_bn',
            't2.roll_number',
            't2.registration_number',
            't2.gpa_result',
            't2.student_photo',
            't2.father_name',
            't2.mother_name',
            't2.tea_stall_name',
            't2.tea_stall_location',
            't2.parent_mobile',
            't2.parent_photo',
            't4.name',
            't4.name_bn',
            't5.name',
            't5.name_bn',
            't6.name',
            't6.name_bn',
            't7.name',
            't7.name_bn',
            't8.name',
            't8.name_bn',
            't10.email',
            't10.name',
            't12.name',
            't13.wing_name',
            't14.wing_name'
        );

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
     * Columns shown on-screen (grouped by user mobile).
     */
    public function selectListColumns(Builder $query, string $type): Builder
    {
        $staffCols = $type === 'rm'
            ? ['t10.email as staff_id', 't10.name as staff_name']
            : ['t10.email as staff_id', 't10.name as staff_name'];

        $wingExpr = $type === 'rm'
            ? DB::raw("(SELECT wing_name FROM tm_wing WHERE aemp_id = t10.aemp_mngr LIMIT 1) as wing_name")
            : DB::raw("COALESCE(t13.wing_name, t14.wing_name, 'No Wing Assigned') as wing_name");

        $regionExpr = DB::raw("COALESCE(
                (SELECT dirg_name FROM tm_dirg WHERE id = t11.dirg_id LIMIT 1),
                (SELECT dirg_name FROM tm_dirg WHERE aemp_id = t10.aemp_mngr LIMIT 1)
            ) as region_name");

        return $query->select(array_merge([
            't11.zone_name as territory_name',
            $regionExpr,
            $wingExpr,
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
            DB::raw("COUNT(t2.id) as total_applications"),
            't12.mobile as user_mobile',
            't12.name as user_name',
            't1.remarks',
        ], $staffCols));
    }

    public function downloadCsv(array $filters, string $type): StreamedResponse
    {
        $query = $type === 'rm' ? $this->rmApprovedQuery($filters) : $this->wmApprovedQuery($filters);

        $staffLabel = $type === 'rm' ? 'RM' : 'WM';

        $wingExpr = $type === 'rm'
            ? "(SELECT wing_name FROM tm_wing WHERE aemp_id = t10.aemp_mngr LIMIT 1) AS WING"
            : "COALESCE(t13.wing_name, t14.wing_name, 'No Wing Assigned') AS WING";

        $query->selectRaw("
            t11.zone_name AS TERRITORY,
            COALESCE(
                (SELECT dirg_name FROM tm_dirg WHERE id = t11.dirg_id LIMIT 1),
                (SELECT dirg_name FROM tm_dirg WHERE aemp_id = t10.aemp_mngr LIMIT 1)
            ) AS REGION,
            {$wingExpr},
            t2.name_en AS STUDENT_NAME,
            t2.name_bn AS STUDENT_NAME_BANGLA,
            t2.roll_number AS ROLL_NUMBER,
            t2.registration_number AS REGISTRATION_NUMBER,
            t2.gpa_result AS GPA_RESULT,
            CONCAT('" . self::UPLOADS_BASE_URL . "', t2.student_photo) AS STUDENT_PHOTO,
            t2.father_name AS FATHER_NAME,
            t2.mother_name AS MOTHER_NAME,
            t2.tea_stall_name AS TEA_STALL_NAME,
            t2.tea_stall_location AS TEA_STALL_LOCATION,
            t2.parent_mobile AS PARENT_MOBILE,
            CONCAT('" . self::UPLOADS_BASE_URL . "', t2.parent_photo) AS PARENT_PHOTO,
            t1.ip_address AS IP_ADDRESS,
            t1.created_at AS CREATED_AT,
            t4.name AS BOARD_NAME,
            t4.name_bn AS BOARD_NAME_BN,
            t5.name AS GROUP_NAME,
            t5.name_bn AS GROUP_NAME_BN,
            t6.name AS DIVISION_NAME,
            t6.name_bn AS DIVISION_NAME_BN,
            t7.name AS DISTRICT_NAME,
            t7.name_bn AS DISTRICT_NAME_BN,
            t8.name AS UPAZILA_NAME,
            t8.name_bn AS UPAZILA_NAME_BN,
            t10.email AS {$staffLabel}_STAFF_ID,
            t10.name AS {$staffLabel}_STAFF_NAME,
            t12.mobile AS USER_MOBILE,
            t12.name AS USER_NAME,
            COUNT(t2.id) AS TOTAL_APPLICATIONS,
            t1.remarks AS REMARKS
        ")->orderBy('t1.created_at', 'desc');

        $fileName = ($type === 'rm' ? 'rm_approved_grouped_' : 'wm_approved_grouped_') . now()->format('Y_m_d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return new StreamedResponse(function () use ($query, $type) {
            $handle = fopen('php://output', 'w');

            if ($handle === false) {
                Log::error('AuditReportService: failed to open output stream for CSV export.');
                return;
            }

            // UTF-8 BOM so Excel opens Bangla text correctly
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            $staffLabel = $type === 'rm' ? 'RM' : 'WM';

            // CSV Header row with all columns
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
                'TOTAL_APPLICATIONS',
                'REMARKS'
            ]);

            try {
                $query->orderBy('t1.created_at')->chunk(500, function ($rows) use ($handle) {
                    foreach ($rows as $row) {
                        fputcsv($handle, (array) $row);
                    }
                });
            } catch (\Throwable $e) {
                Log::error('AuditReportService: CSV export failed mid-stream: ' . $e->getMessage());
            }

            fclose($handle);
        }, 200, $headers);
    }
}
