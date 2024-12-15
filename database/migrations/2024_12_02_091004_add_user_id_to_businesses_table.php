<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('businesses', function (Blueprint $table) {
            if (!Schema::hasColumn('businesses', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable(false);
            }
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Clé étrangère vers la table users
        });
    }

    public function down()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Supprimer la clé étrangère
            $table->dropColumn('user_id'); // Supprimer la colonne user_id
        });
    }

};
