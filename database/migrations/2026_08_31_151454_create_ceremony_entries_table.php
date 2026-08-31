// database/migrations/2026_08_11_000000_create_ceremony_entries_table.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ceremony_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('student_detail_id')->constrained('student_details')->onDelete('cascade');
            $table->enum('status', ['approved', 'denied'])->default('approved');
            $table->text('remarks')->nullable();
            $table->timestamp('scanned_at');
            $table->timestamps();

            // Indexes
            $table->index('student_id');
            $table->index('scanned_at');
            // Unique constraint: one entry per student per day
            $table->unique(['student_id', 'scanned_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ceremony_entries');
    }
};
