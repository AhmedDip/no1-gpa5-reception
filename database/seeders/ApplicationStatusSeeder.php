<?php
// database/seeders/ApplicationStatusSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApplicationStatus;

class ApplicationStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['name' => 'Pending',         'slug' => 'pending',         'color' => '#680bc5', 'order' => 1, 'description' => 'Application submitted, awaiting Regional Manager review'],
            ['name' => 'Approved by RM',  'slug' => 'approved_by_rm',  'color' => '#0d6efd', 'order' => 2, 'description' => 'Approved by the Regional Manager, awaiting Wing Manager review'],
            ['name' => 'Rejected by RM',  'slug' => 'rejected_by_rm',  'color' => '#e8590c', 'order' => 3, 'description' => 'Rejected by the Regional Manager (not final — Admin can still approve)'],
            ['name' => 'Approved by WM',  'slug' => 'approved_by_wm',  'color' => '#fd7e14', 'order' => 4, 'description' => 'Approved by the Wing Manager, awaiting final Admin approval'],
            ['name' => 'Rejected by WM',  'slug' => 'rejected_by_wm',  'color' => '#d6336c', 'order' => 5, 'description' => 'Rejected by the Wing Manager (not final — Admin can still approve)'],
            ['name' => 'Approved',        'slug' => 'approved',        'color' => '#0b9164', 'order' => 6, 'description' => 'Application approved successfully (final)'],
            ['name' => 'Rejected',        'slug' => 'rejected',        'color' => '#c12750', 'order' => 7, 'description' => 'Application rejected by Admin (final)'],
        ];

        foreach ($statuses as $status) {
            ApplicationStatus::updateOrCreate(['slug' => $status['slug']], $status);
        }
    }
}
