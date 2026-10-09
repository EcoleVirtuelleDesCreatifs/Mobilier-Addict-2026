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
        Schema::create('space_sections', function (Blueprint $table) {
            $table->id();
            $table->string('badge')->nullable();
            $table->string('badge_icon')->nullable();
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->string('background_color')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('space_sections');
    }
};
