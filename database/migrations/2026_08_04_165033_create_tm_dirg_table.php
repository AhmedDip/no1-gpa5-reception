<?php
// database/migrations/2026_08_04_000001_create_tm_dirg_table.php

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
        Schema::create('tm_dirg', function (Blueprint $table) {
            $table->id();
            $table->string('dirg_name', 255);
            $table->string('dirg_code', 255)->unique();
            $table->integer('aemp_id');
            $table->integer('sdvm_id');
            $table->string('sdvm_code', 255)->default('-');
            $table->integer('cont_id');
            $table->integer('lfcl_id');
            $table->integer('aemp_iusr');
            $table->integer('aemp_eusr');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->tinyInteger('var')->default(1);
            $table->string('attr1', 255)->default('-');
            $table->string('attr2', 5)->default('-');
            $table->integer('attr3')->default(0);
            $table->integer('attr4')->default(0);

            // Indexes
            $table->index('aemp_eusr');
            $table->index('aemp_iusr');
            $table->index('lfcl_id');
            $table->index('cont_id');
            $table->index('sdvm_id');
            $table->index(['dirg_name', 'dirg_code']);

            // Foreign key constraints (commented out as referenced tables may not exist yet)
            // $table->foreign('aemp_eusr')->references('id')->on('tm_aemp');
            // $table->foreign('aemp_iusr')->references('id')->on('tm_aemp');
            // $table->foreign('cont_id')->references('id')->on('tm_cont');
            // $table->foreign('lfcl_id')->references('id')->on('tm_lfcl');
            // $table->foreign('sdvm_id')->references('id')->on('tm_sdvm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_dirg');
    }
};
