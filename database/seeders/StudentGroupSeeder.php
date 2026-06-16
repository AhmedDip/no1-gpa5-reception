<?php
// database/seeders/StudentGroupSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentGroup;
use App\Constants;

class StudentGroupSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Constants::STUDENT_GROUPS as $group) {
            StudentGroup::create($group);
        }
    }
}