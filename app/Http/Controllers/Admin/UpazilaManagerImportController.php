<?php
// app/Http/Controllers/Admin/UpazilaManagerImportController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UpazilaManagerAssignment;


class UpazilaManagerImportController extends Controller
{
    public function index()
    {
        $assignments = UpazilaManagerAssignment::with('manager')
            ->orderBy('upazila_id')
            ->get();

        $page_content = [
            'page_title'      => 'Upazila Manager Assignments',
            'module_name'     => 'Settings',
            'module_route'    => route('admin.upazila-managers.index'),
            'sub_module_name' => 'Upazila Assignments',
        ];

        return view('backend.modules.admin.upazila-managers.index', compact('assignments', 'page_content'));
    }

}
