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
        Schema::create('student_enrollment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_student')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_course')->constrained('courses')->onDelete('cascade');
            $table->timestamp("enrollment_date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_enrollment');
    }
};
