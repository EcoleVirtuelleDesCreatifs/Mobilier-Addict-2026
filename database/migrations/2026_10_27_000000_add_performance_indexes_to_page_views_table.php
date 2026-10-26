<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('page_views', function (Blueprint $table) {
            $table->index(['created_at', 'visitor_id'], 'page_views_created_visitor_index');
            $table->index(['route_name', 'created_at'], 'page_views_route_created_index');
            $table->index(['visitor_id', 'created_at'], 'page_views_visitor_created_index');
        });
    }

    public function down(): void
    {
        Schema::table('page_views', function (Blueprint $table) {
            $table->dropIndex('page_views_created_visitor_index');
            $table->dropIndex('page_views_route_created_index');
            $table->dropIndex('page_views_visitor_created_index');
        });
    }
};
