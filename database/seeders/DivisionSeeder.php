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
            ['name' => 'Barisal', 'name_bn' => 'বরিশাল', 'code' => '10', 'lfcl_id' => 1],
            ['name' => 'Chittagong', 'name_bn' => 'চট্টগ্রাম', 'code' => '20', 'lfcl_id' => 1],
            ['name' => 'Dhaka', 'name_bn' => 'ঢাকা', 'code' => '30', 'lfcl_id' => 1],
            ['name' => 'Khulna', 'name_bn' => 'খুলনা', 'code' => '40', 'lfcl_id' => 1],
            ['name' => 'Rajshahi', 'name_bn' => 'রাজশাহী', 'code' => '50', 'lfcl_id' => 1],
            ['name' => 'Rangpur', 'name_bn' => 'রংপুর', 'code' => '55', 'lfcl_id' => 1],
            ['name' => 'Sylhet', 'name_bn' => 'সিলেট', 'code' => '60', 'lfcl_id' => 1],
            ['name' => 'Mymensingh', 'name_bn' => 'ময়মনসিংহ', 'code' => '70', 'lfcl_id' => 1],
        ];

        foreach ($divisions as $division) {
            Division::create($division);
        }
    }
}
