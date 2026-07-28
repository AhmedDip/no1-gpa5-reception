<?php
// database/seeders/ApplicationStatusSeeder.php

namespace Database\Seeders;

use App\Models\ApplicationStatus;
use Illuminate\Database\Seeder;

class ApplicationStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['name' => 'Pending', 'slug' => 'pending', 'color' => '#680bc5', 'order' => 1, 'description' => 'আবেদন জমা দেওয়া হয়েছে, রিজিওনাল ম্যানেজারের পর্যালোচনার জন্য অপেক্ষা করছে'],
            ['name' => 'Approved by Regional Manager', 'slug' => 'approved_by_rm', 'color' => '#0d6efd', 'order' => 2, 'description' => 'রিজিওনাল ম্যানেজারের দ্বারা অনুমোদিত, উইং ম্যানেজারের পর্যালোচনার জন্য অপেক্ষা করছে'],
            ['name' => 'Rejected by Regional Manager', 'slug' => 'rejected_by_rm', 'color' => '#e8590c', 'order' => 3, 'description' => 'রিজিওনাল ম্যানেজারের দ্বারা প্রত্যাখ্যাত (চূড়ান্ত নয় - অ্যাডমিন এখনও অনুমোদন করতে পারে)'],
            ['name' => 'Approved by Wing Manager', 'slug' => 'approved_by_wm', 'color' => '#fd7e14', 'order' => 4, 'description' => 'উইং ম্যানেজার দ্বারা অনুমোদিত, চূড়ান্ত প্রশাসক অনুমোদনের জন্য অপেক্ষা করছে'],
            ['name' => 'Rejected by Wing Manager', 'slug' => 'rejected_by_wm', 'color' => '#d6336c', 'order' => 5, 'description' => 'উইং ম্যানেজার দ্বারা প্রত্যাখ্যাত (চূড়ান্ত নয় - অ্যাডমিন এখনও অনুমোদন করতে পারে)'],
            ['name' => 'Approved', 'slug' => 'approved', 'color' => '#0b9164', 'order' => 6, 'description' => 'আবেদন সফলভাবে অনুমোদিত হয়েছে (চূড়ান্ত)'],
            ['name' => 'Rejected', 'slug' => 'rejected', 'color' => '#df144a', 'order' => 7, 'description' => 'অ্যাডমিন দ্বারা চূড়ান্তভাবে প্রত্যাখ্যাত'],
        ];
        foreach ($statuses as $status) {
            ApplicationStatus::updateOrCreate(['slug' => $status['slug']], $status);
        }
    }
}
