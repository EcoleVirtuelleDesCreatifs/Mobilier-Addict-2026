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
        Schema::create('favorite_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('favorite_section_id')->constrained('favorite_sections')->onDelete('cascade');

            $table->nullableMorphs('itemable');

            $table->unsignedInteger('rank')->nullable();
            $table->unsignedInteger('votes_count')->default(0);
            $table->decimal('rating', 2, 1)->default(0);

            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();

            $table->decimal('price', 12, 2)->nullable();
            $table->decimal('old_price', 12, 2)->nullable();
            $table->string('cta_text')->nullable();
            $table->string('cta_url')->nullable();

            $table->boolean('is_hero')->default(false);
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['favorite_section_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorite_items');
    }
};
