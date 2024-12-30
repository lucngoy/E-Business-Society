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
        Schema::table('notifications', function (Blueprint $table) {
            // Revert to INT auto-increment
            $table->dropColumn('id'); // Supprimer la colonne existante

            $table->increments('id'); // Ajouter la colonne auto-increment
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Optionnel : Revenir à UUID si vous souhaitez annuler la migration
            $table->uuid('id')->primary()->change();
        });
    }
};
