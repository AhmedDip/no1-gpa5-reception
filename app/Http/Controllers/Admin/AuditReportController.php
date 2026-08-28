<?php
// app/Http/Controllers/Admin/AuditReportController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\Division;
use App\Services\AuditReportService;
use Illuminate\Http\Request;

class AuditReportController extends Controller
{
    public function __construct(private AuditReportService $auditReportService)
    {
    }

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'date_from', 'date_to', 'board', 'division']);
        $type    = $request->input('type', 'rm'); // 'rm' or 'wm'

        $query = $type === 'wm'
            ? $this->auditReportService->wmApprovedQuery($filters)
            : $this->auditReportService->rmApprovedQuery($filters);

        $records = $this->auditReportService
            ->selectListColumns($query, $type)
            ->orderBy('t1.created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        $boards    = Board::orderBy('name')->get();
        $divisions = Division::orderBy('name')->get();

        $page_content = [
            'page_title'      => 'RM / WM Approved Audit Report',
            'module_name'     => 'Reports',
            'module_route'    => route('admin.reports.audit-approvals.index'),
            'sub_module_name' => 'Approval Audit',
        ];

        return view('backend.modules.admin.reports.audit-approvals.index', compact(
            'records', 'boards', 'divisions', 'filters', 'type', 'page_content'
        ));
    }

    public function exportRmApproved(Request $request)
    {
        $filters = $request->only(['search', 'date_from', 'date_to', 'board', 'division']);
        return $this->auditReportService->downloadCsv($filters, 'rm');
    }

    public function exportWmApproved(Request $request)
    {
        $filters = $request->only(['search', 'date_from', 'date_to', 'board', 'division']);
        return $this->auditReportService->downloadCsv($filters, 'wm');
    }
}
