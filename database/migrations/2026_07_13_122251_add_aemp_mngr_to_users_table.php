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
            $table->index('aemp_mngr');
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
        });
    }
};
