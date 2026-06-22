<?php
// database/seeders/SSCBoardSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Board;
use App\Constants;

class SSCBoardSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Constants::SSC_BOARDS as $board) {
            Board::create($board);
        }
    }
}
