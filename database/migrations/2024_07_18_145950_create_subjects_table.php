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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->integer('credit_hour');
            $table->boolean('is_elective')->default(false);
            $table->foreignId('syllabus_id')->constrained('syllabi')->onDelete('cascade')->nullable();
            $table->foreignId('faculty_id')->constrained('faculties')->onDelete('cascade')->nullable();
            $table->foreignId('semester_id')->constrained('semesters')->onDelete('cascade')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
