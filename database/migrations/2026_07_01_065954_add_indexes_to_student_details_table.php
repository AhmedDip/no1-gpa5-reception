<?php
// database/migrations/2026_07_01_000000_add_indexes_to_student_details_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_details', function (Blueprint $table) {
            $table->index('application_status_id');
            $table->index('created_at');
            $table->index(['application_status_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::table('student_details', function (Blueprint $table) {
            $table->dropIndex(['student_details_application_status_id_index']);
            $table->dropIndex(['student_details_created_at_index']);
            $table->dropIndex(['student_details_application_status_id_created_at_index']);
        });
    }
};