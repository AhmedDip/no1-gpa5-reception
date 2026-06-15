<?php
// database/seeders/SSCBoardSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SSCBoard;
use App\Constants;

class SSCBoardSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Constants::SSC_BOARDS as $board) {
            SSCBoard::create($board);
        }
    }
}