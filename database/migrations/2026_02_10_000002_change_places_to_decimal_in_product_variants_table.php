<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('product_variants') || !Schema::hasColumn('product_variants', 'places')) {
            return;
        }

        $indexes = collect(DB::select('SHOW INDEX FROM `product_variants`'))
            ->pluck('Key_name')
            ->unique()
            ->values();

        if ($indexes->contains('product_variants_product_id_thickness_cm_places_unique')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->dropUnique('product_variants_product_id_thickness_cm_places_unique');
            });
        }

        if ($indexes->contains('pv_prod_places_thick_type_uq')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->dropUnique('pv_prod_places_thick_type_uq');
            });
        }

        DB::statement('ALTER TABLE `product_variants` MODIFY `places` DECIMAL(3,1) NOT NULL');

        $hasVariantTypeColumn = Schema::hasColumn('product_variants', 'variant_type');

        if ($hasVariantTypeColumn) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->unique(['product_id', 'places', 'thickness_cm', 'variant_type'], 'pv_prod_places_thick_type_uq');
            });
        } else {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->unique(['product_id', 'thickness_cm', 'places']);
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('product_variants') || !Schema::hasColumn('product_variants', 'places')) {
            return;
        }

        $indexes = collect(DB::select('SHOW INDEX FROM `product_variants`'))
            ->pluck('Key_name')
            ->unique()
            ->values();

        if ($indexes->contains('product_variants_product_id_thickness_cm_places_unique')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->dropUnique('product_variants_product_id_thickness_cm_places_unique');
            });
        }

        if ($indexes->contains('pv_prod_places_thick_type_uq')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->dropUnique('pv_prod_places_thick_type_uq');
            });
        }

        DB::statement('ALTER TABLE `product_variants` MODIFY `places` INT UNSIGNED NOT NULL');

        $hasVariantTypeColumn = Schema::hasColumn('product_variants', 'variant_type');

        if ($hasVariantTypeColumn) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->unique(['product_id', 'places', 'thickness_cm', 'variant_type'], 'pv_prod_places_thick_type_uq');
            });
        } else {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->unique(['product_id', 'thickness_cm', 'places']);
            });
        }
    }
};
