<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            
            // Student Basic Information
            $table->string('name_en')->nullable();
            $table->string('name_bn')->nullable();
            $table->unsignedBigInteger('ssc_board_id')->nullable();
            $table->unsignedBigInteger('student_group_id')->nullable();
            $table->string('roll_number')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('gpa_result')->nullable();
            $table->string('student_photo')->nullable();
            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('upazila_id')->nullable();
            
            // Parent Information
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('tea_stall_name')->nullable();
            $table->string('tea_stall_location')->nullable();
            $table->string('parent_mobile')->nullable();
            $table->string('parent_photo')->nullable();
            
            // Status Flags
            $table->boolean('is_parent_info_provided')->default(false);
            $table->unsignedBigInteger('application_status_id')->default(1);
            
            $table->timestamps();
            
            
            $table->index('user_id');
            $table->index('ssc_board_id');
            $table->index('student_group_id');
            $table->index('division_id');
            $table->index('district_id');
            $table->index('upazila_id');
            $table->index('roll_number');
            $table->index('registration_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};