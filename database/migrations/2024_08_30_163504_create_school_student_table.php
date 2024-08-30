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
        Schema::create('school_student', function (Blueprint $table) {
            $table->id();
            $table->uuid('school_id'); // Foreign key to the schools table
            $table->uuid('student_id'); // Foreign key to the students table
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            // Ensure the combination of school_id and student_id is unique
            $table->unique(['school_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_student', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropForeign(['student_id']);
        });

        Schema::dropIfExists('school_student');
    }
};