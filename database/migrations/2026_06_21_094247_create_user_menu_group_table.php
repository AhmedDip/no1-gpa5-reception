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
        Schema::create('tl_wsmu', function (Blueprint $table) {
            $table->id();
            $table->integer('wsmn_id');
            $table->integer('wmng_id');
            $table->boolean('wsmu_vsbl')->default(1);
            $table->boolean('wsmu_crat')->default(1);
            $table->boolean('wsmu_read')->default(1);
            $table->boolean('wsmu_updt')->default(1);
            $table->boolean('wsmu_delt')->default(1);
            $table->integer('cont_id')->default(1);
            $table->integer('lfcl_id')->default(1);
            $table->integer('aemp_iusr')->default(1);
            $table->integer('aemp_eusr')->default(1);
            $table->timestamps();
            $table->tinyInteger('var')->default(1);
            $table->string('attr1', 5)->default('-');
            $table->string('attr2', 5)->default('-');
            $table->integer('attr3')->default(0);
            $table->integer('attr4')->default(0);

            $table->unique(['wsmn_id', 'wmng_id']);
            $table->index('wmng_id');
            $table->index(['wsmu_vsbl', 'wsmu_crat', 'wsmu_read', 'wsmu_updt', 'wsmu_delt']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tl_wsmu');
    }
};
