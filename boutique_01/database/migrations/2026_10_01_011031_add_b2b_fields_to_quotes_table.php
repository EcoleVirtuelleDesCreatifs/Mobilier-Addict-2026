<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->string('company_name')->nullable()->after('firstnames');
            $table->string('email')->nullable()->after('phone');
            $table->string('organization_type')->nullable()->after('email');
            $table->string('budget_range')->nullable()->after('details');
        });
    }

    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn(['company_name', 'email', 'organization_type', 'budget_range']);
        });
    }
};
