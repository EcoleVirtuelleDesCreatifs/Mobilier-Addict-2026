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
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('rating', 2, 1)->default(0)->after('color');
            $table->integer('reviews_count')->default(0)->after('rating');
            $table->string('firmness')->nullable()->after('reviews_count');
            $table->string('thickness')->nullable()->after('firmness');
            $table->string('size')->nullable()->after('thickness');
            $table->boolean('is_collection')->default(false)->after('is_bestseller');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['rating', 'reviews_count', 'firmness', 'thickness', 'size', 'is_collection']);
        });
    }
};
