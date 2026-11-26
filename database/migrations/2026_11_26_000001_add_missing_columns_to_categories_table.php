<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Le modèle Category et l'admin utilisent la colonne « color », absente de la
 * première migration de la table : la création d'une catégorie échouait.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('categories') || Schema::hasColumn('categories', 'color')) {
            return;
        }

        Schema::table('categories', function (Blueprint $table) {
            $table->string('color', 20)->nullable()->after('image_alt');
        });
    }

    public function down(): void
    {
        // Colonne conservée : elle peut exister indépendamment de cette migration.
    }
};
