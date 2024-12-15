<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            if (!Schema::hasColumn('businesses', 'image')) {
                // Ajoute la colonne 'image' de type string (pour l'URL de l'image)
                $table->string('image')->nullable();
            }

            if (!Schema::hasColumn('businesses', 'opening_hours')) {
                // Ajoute la colonne 'opening_hours' de type text (pour stocker les horaires d'ouverture)
                $table->text('opening_hours')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            // Supprime les colonnes si la migration est annulée
            $table->dropColumn(['image', 'opening_hours']);
        });
    }

};
