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
            ['name' => 'Pending',     'slug' => 'pending',     'color' => '#680bc5', 'order' => 1, 'description' => 'Application submitted and awaiting review'],
            ['name' => 'Approved',    'slug' => 'approved',    'color' => '#0b9164', 'order' => 2, 'description' => 'Application approved successfully'],
            ['name' => 'Rejected',    'slug' => 'rejected',    'color' => '#c12750', 'order' => 3, 'description' => 'Application rejected'],
            ['name' => 'Under Review','slug' => 'under-review','color' => '#18a6ab', 'order' => 4, 'description' => 'Application is under review'],
        ];

        foreach ($statuses as $status) {
            ApplicationStatus::firstOrCreate(['slug' => $status['slug']], $status);
        }
    }
}
