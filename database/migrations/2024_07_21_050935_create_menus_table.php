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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->foreignId('group_id')->constrained('menu_groups')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->string('class')->nullable();
            $table->string('icon')->nullable();
            $table->string('route');
            $table->string('url')->nullable();
            $table->boolean('is_active');
            $table->integer('order');
            $table->text('related_routes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
