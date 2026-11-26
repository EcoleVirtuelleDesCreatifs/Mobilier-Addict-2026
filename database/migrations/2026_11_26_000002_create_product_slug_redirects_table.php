<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** Anciennes adresses /produit/{slug} redirigées en 301 vers la fiche actuelle. */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('product_slug_redirects')) {
            return;
        }

        Schema::create('product_slug_redirects', function (Blueprint $table) {
            $table->id();
            $table->string('old_slug')->unique();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_slug_redirects');
    }
};
