<?php
// database/seeders/DivisionSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        $divisions = [
            ['name' => 'Dhaka', 'name_bn' => 'ঢাকা', 'code' => 'DHA'],
            ['name' => 'Chittagong', 'name_bn' => 'চট্টগ্রাম', 'code' => 'CHI'],
            ['name' => 'Rajshahi', 'name_bn' => 'রাজশাহী', 'code' => 'RAJ'],
            ['name' => 'Khulna', 'name_bn' => 'খুলনা', 'code' => 'KHU'],
            ['name' => 'Barisal', 'name_bn' => 'বরিশাল', 'code' => 'BAR'],
            ['name' => 'Sylhet', 'name_bn' => 'সিলেট', 'code' => 'SYL'],
            ['name' => 'Rangpur', 'name_bn' => 'রংপুর', 'code' => 'RAN'],
            ['name' => 'Mymensingh', 'name_bn' => 'ময়মনসিংহ', 'code' => 'MYM'],
        ];

        foreach ($divisions as $division) {
            Division::create($division);
        }
    }
}