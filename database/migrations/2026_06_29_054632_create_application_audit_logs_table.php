<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('application_audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_detail_id');
            $table->unsignedBigInteger('performed_by');
            $table->string('action');
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('previous_status_id')->nullable();
            $table->unsignedBigInteger('new_status_id')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();

            $table->index('student_detail_id');
            $table->index('performed_by');
            $table->index('action');
        });

        Schema::table('student_details', function (Blueprint $table) {
            $table->timestamp('sms_sent_at')->nullable()->after('application_status_id');
            $table->boolean('notification_sent')->default(false)->after('sms_sent_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_audit_logs');

        Schema::table('student_details', function (Blueprint $table) {
            $table->dropColumn(['sms_sent_at', 'notification_sent']);
        });
    }
};
