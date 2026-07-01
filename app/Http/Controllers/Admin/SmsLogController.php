<?php
// app/Http/Controllers/Admin/SmsLogController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmsLog;
use App\Models\StudentDetail;
use Illuminate\Http\Request;

class SmsLogController extends Controller
{
    public function index(Request $request)
    {
        $query = SmsLog::with(['studentDetail', 'sentBy'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('student_detail_id')) {
            $query->where('student_detail_id', $request->student_detail_id);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('mobile', 'LIKE', "%{$s}%")
                    ->orWhereHas('studentDetail', function ($sub) use ($s) {
                        $sub->where('name_en', 'LIKE', "%{$s}%")
                            ->orWhere('name_bn', 'LIKE', "%{$s}%");
                    });
            });
        }

        $logs = $query->paginate(20)->withQueryString();

        $counts = [
            'total'  => SmsLog::count(),
            'sent'   => SmsLog::where('status', 'sent')->count(),
            'failed' => SmsLog::where('status', 'failed')->count(),
        ];

        $filteredStudent = $request->filled('student_detail_id')
            ? StudentDetail::find($request->student_detail_id)
            : null;

        $page_content = [
            'page_title'      => 'SMS Logs',
            'module_name'     => 'Applications',
            'module_route'    => route('admin.applications.index'),
            'sub_module_name' => 'SMS Logs',
        ];

        $driver = config('services.sms.driver', 'log');

        return view('backend.modules.admin.sms-logs.index', compact(
            'logs',
            'counts',
            'page_content',
            'driver',
            'filteredStudent'
        ));
    }
}
