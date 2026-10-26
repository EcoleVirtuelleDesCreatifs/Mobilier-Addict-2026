<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('page_views', function (Blueprint $table) {
            $table->string('source', 60)->nullable()->after('referer')->index();
            $table->string('medium', 20)->nullable()->after('source')->index();
            $table->string('campaign', 120)->nullable()->after('medium');
            $table->string('country', 80)->nullable()->after('ip');
            $table->char('country_code', 2)->nullable()->after('country');
            $table->string('region', 80)->nullable()->after('country_code');
            $table->string('city', 80)->nullable()->after('region')->index();
        });
    }

    public function down(): void
    {
        Schema::table('page_views', function (Blueprint $table) {
            $table->dropIndex(['source']);
            $table->dropIndex(['medium']);
            $table->dropIndex(['city']);
            $table->dropColumn(['source', 'medium', 'campaign', 'country', 'country_code', 'region', 'city']);
        });
    }
};
