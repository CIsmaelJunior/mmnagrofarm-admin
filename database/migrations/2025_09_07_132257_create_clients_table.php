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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            
            // Informations personnelles
            $table->string('nom');
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->string('entreprise')->nullable();
            
            // Informations de livraison
            $table->text('adresse_livraison')->nullable();
            $table->string('ville')->nullable();
            $table->string('code_postal')->nullable();
            
            // Informations supplémentaires
            $table->text('notes')->nullable();
            $table->boolean('actif')->default(true);
            
            // Soft deletes
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable();
            
            $table->timestamps();
            
            // Index pour les recherches
            $table->index('email');
            $table->index('nom');
            $table->index('ville');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
