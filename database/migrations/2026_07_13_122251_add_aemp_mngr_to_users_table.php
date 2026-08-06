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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('aemp_mngr')->default(1)->after('wmng_id');
            $table->unsignedBigInteger('zone_id')->nullable()->after('aemp_mngr');
            $table->index('aemp_mngr');
            $table->index('zone_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['aemp_mngr']);
            $table->dropColumn('aemp_mngr');
            $table->dropIndex(['zone_id']);
            $table->dropColumn('zone_id');
        });
    }
};
