<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('save_the_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('blog_posts')->cascadeOnDelete();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();

            $table->unique('article_id');
            $table->index('order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('save_the_dates');
    }
};
