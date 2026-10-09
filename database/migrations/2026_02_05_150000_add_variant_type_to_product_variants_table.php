<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $indexes = collect(DB::select('SHOW INDEX FROM `product_variants`'))
            ->pluck('Key_name')
            ->unique()
            ->values();

        if (!Schema::hasColumn('product_variants', 'variant_type')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->string('variant_type')->nullable()->after('product_id');
            });
        }

        if (!$indexes->contains('product_variants_product_id_index') && !$indexes->contains('product_id')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->index('product_id');
            });
        }

        if ($indexes->contains('product_variants_product_id_thickness_cm_places_unique')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->dropUnique('product_variants_product_id_thickness_cm_places_unique');
            });
        }

        $newUniqueName = 'pv_prod_places_thick_type_uq';
        if (!$indexes->contains($newUniqueName)) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->unique(['product_id', 'places', 'thickness_cm', 'variant_type'], 'pv_prod_places_thick_type_uq');
            });
        }
    }

    public function down(): void
    {
        $indexes = collect(DB::select('SHOW INDEX FROM `product_variants`'))
            ->pluck('Key_name')
            ->unique()
            ->values();

        $newUniqueName = 'pv_prod_places_thick_type_uq';
        if ($indexes->contains($newUniqueName)) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->dropUnique('pv_prod_places_thick_type_uq');
            });
        }

        if (!$indexes->contains('product_variants_product_id_thickness_cm_places_unique')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->unique(['product_id', 'thickness_cm', 'places']);
            });
        }

        if (Schema::hasColumn('product_variants', 'variant_type')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->dropColumn('variant_type');
            });
        }
    }
};
