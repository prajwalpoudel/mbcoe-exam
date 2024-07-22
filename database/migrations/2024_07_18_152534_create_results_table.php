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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('grade')->nullable();
            $table->string('remarks')->nullable();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade')->nullable();
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade')->nullable();
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
