<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('writer')->after('email');
            $table->string('fonction')->nullable()->after('role');
            $table->string('profile_picture')->nullable()->after('fonction');
            $table->boolean('is_active')->default(true)->after('profile_picture');
            $table->timestamp('last_login_at')->nullable()->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'fonction', 'profile_picture', 'is_active', 'last_login_at']);
        });
    }
};
