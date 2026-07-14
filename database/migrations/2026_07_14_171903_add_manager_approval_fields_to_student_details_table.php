<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('student_details', function (Blueprint $table) {
            $table->unsignedBigInteger('rm_reviewed_by')->nullable()->after('application_status_id');
            $table->timestamp('rm_reviewed_at')->nullable()->after('rm_reviewed_by');
            $table->unsignedBigInteger('wm_reviewed_by')->nullable()->after('rm_reviewed_at');
            $table->timestamp('wm_reviewed_at')->nullable()->after('wm_reviewed_by');

            $table->index('rm_reviewed_by');
            $table->index('wm_reviewed_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_details', function (Blueprint $table) {
            $table->dropIndex(['rm_reviewed_by']);
            $table->dropIndex(['wm_reviewed_by']);
            $table->dropColumn(['rm_reviewed_by', 'rm_reviewed_at', 'wm_reviewed_by', 'wm_reviewed_at']);
        });
    }
};
