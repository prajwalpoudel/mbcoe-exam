<?php

use App\Constants\StatusConstant;
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
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('display_name')->nullable();
            $table->string('code')->nullable();
            $table->integer('order')->nullable();
            $table->integer('no_of_elective')->default(0);
            $table->enum('status', [StatusConstant::RUNNING, StatusConstant::PASSOUT])->default(StatusConstant::RUNNING);
            $table->foreignId('faculty_id')->constrained('faculties')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semesters');
    }
};
