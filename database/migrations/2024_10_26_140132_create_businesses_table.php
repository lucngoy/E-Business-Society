<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->text('address');
            $table->string('phone');
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->text('opening_hours')->nullable();
            $table->json('images')->nullable();
            $table->unsignedBigInteger('user_id'); // ID de l'utilisateur
            $table->timestamps();

            // Clé étrangère pour la catégorie
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // Clé étrangère pour l'utilisateur
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
}
