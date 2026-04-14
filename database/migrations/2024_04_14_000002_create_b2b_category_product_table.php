<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('b2b_category_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('b2b_category_id')->constrained('b2b_categories')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['b2b_category_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('b2b_category_product');
    }
};
