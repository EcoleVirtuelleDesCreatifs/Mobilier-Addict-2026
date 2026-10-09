<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('game_participants')) {
            return;
        }

        Schema::create('game_participants', function (Blueprint $table) {
            $table->id();
            $table->string('lastname');
            $table->string('firstnames');
            $table->string('whatsapp', 32);
            $table->string('city');
            $table->string('public_name');
            $table->string('photo')->nullable();
            $table->string('prize');
            $table->string('slug')->unique();
            $table->string('badge_path')->nullable();
            $table->unsignedBigInteger('supports_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_participants');
    }
};
