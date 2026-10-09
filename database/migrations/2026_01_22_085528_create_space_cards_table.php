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
        Schema::create('space_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('space_section_id')->constrained('space_sections')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('image_alt')->nullable();
            $table->string('cta_text')->nullable();
            $table->string('cta_url')->nullable();
            $table->enum('size', ['small', 'large'])->default('small');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['space_section_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('space_cards');
    }
};
