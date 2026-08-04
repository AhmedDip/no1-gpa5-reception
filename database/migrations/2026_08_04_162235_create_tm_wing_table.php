<?php
// database/migrations/2026_08_04_000000_create_tm_wing_table.php

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
        Schema::create('tm_wing', function (Blueprint $table) {
            $table->id();
            $table->string('wing_name', 255);
            $table->string('wing_code', 255)->unique();
            $table->integer('aemp_id');
            $table->integer('slgp_id');
            $table->integer('cont_id');
            $table->integer('lfcl_id');
            $table->integer('aemp_iusr');
            $table->integer('aemp_eusr');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->tinyInteger('var')->default(1);
            $table->string('attr1', 5)->default('-');
            $table->string('attr2', 5)->default('-');
            $table->integer('attr3')->default(0);
            $table->integer('attr4')->default(0);

            // Indexes
            $table->index('cont_id');
            $table->index('lfcl_id');
            $table->index('aemp_iusr');
            $table->index('aemp_eusr');
            $table->index('slgp_id');
            $table->index(['wing_name', 'wing_code']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_wing');
    }
};
