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
        Schema::create('tm_wsmn', function (Blueprint $table) {
            $table->id();
            $table->string('wsmn_name', 30);
            $table->string('wsmn_wurl', 100);
            $table->integer('wmnu_id');
            $table->integer('wsmn_oseq');
            $table->string('wsmn_ukey', 255)->unique();
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

            $table->index('wmnu_id');
            $table->index('wsmn_ukey');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_wsmn');
    }
};
