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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('nom');
            $table->string('variete');
            $table->text('description');
            $table->string('origine');
            $table->text('gout');
            $table->text('conservation');
            $table->string('saison');
            $table->text('usage');
            $table->json('conditionnement'); // Array des conditionnements
            $table->string('image');
            $table->decimal('prix', 10, 2)->nullable();
            $table->json('bienfaits'); // Array des bienfaits
            $table->softDeletes(); // Ajoute deleted_at
            $table->unsignedBigInteger('deleted_by')->nullable(); // Utilisateur qui a supprimé
            $table->timestamps();

            // Index pour les recherches
            $table->index(['nom', 'variete']);
            $table->index('origine');
            $table->index('saison');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
