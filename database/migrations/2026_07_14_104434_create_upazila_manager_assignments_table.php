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
        Schema::create('upazila_manager_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('upazila_id');
            $table->string('upazila_name');
            $table->string('staff_id', 20)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('staff_id');
            $table->index('upazila_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upazila_manager_assignments');
    }
};
