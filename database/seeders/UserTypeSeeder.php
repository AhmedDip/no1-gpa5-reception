<?php
// database/seeders/UserTypeSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserType;
use App\Constants;

class UserTypeSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Constants::USER_TYPES as $type) {
            UserType::create($type);
        }
    }
}