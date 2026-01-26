<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->string('status')->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('shipping_method')->nullable();

            $table->string('lastname');
            $table->string('firstnames');
            $table->string('whatsapp');
            $table->string('phone')->nullable();
            $table->string('delivery_place');
            $table->date('delivery_day')->nullable();
            $table->text('details')->nullable();

            $table->decimal('subtotal', 12, 2);
            $table->decimal('shipping_amount', 12, 2)->default(0);
            $table->decimal('total', 12, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
