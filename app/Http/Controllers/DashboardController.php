<?php

namespace App\Http\Controllers;



class DashboardController extends Controller
{
    public function home()
    {
        $page_content = [
            'page_title'      => __('HOME'),
        ];
        return view('backend.modules.dashboard.mtd', compact('page_content'));
    }

    public function indexMtd()
    {
        $page_content = [
            'page_title'      => __('MTD'),
            'module_name'     => __('MTD'),
            // 'module_route'    => route('dashboard.mtd')
            // 'sub_module_name' => __('MTD-SUB'),
        ];
        return view('modules.dashboard.mtd', compact('page_content'));
    }

    public function indexTimeline()
    {
        $page_content = [
            'page_title'      => __('Timeline'),
            'module_name'     => __('Timeline')
        ];
        return view('modules.dashboard.timeline', compact('page_content'));
    }

    public function indexSummary()
    {
        $page_content = [
            'page_title'      => __('Summary'),
            'module_name'     => __('Summary')
        ];
        return view('modules.dashboard.summary', compact('page_content'));
    }


    public function UserSummary()
    {
        $page_content = [
            'page_title'      => __('User Summary'),
            'module_name'     => __('User'),
            'sub_module_name' => __('Summary'),
            'module_route'    => route('dashboard.user-summary')
        ];
        return view('modules.dashboard.user-summary', compact('page_content'));
    }

    public function promotion()
    {
        $page_content = [
            'page_title'      => __('Promotion'),
            'module_name'     => __('Promotion')
        ];
        return view('modules.dashboard.promotion', compact('page_content'));
    }
}