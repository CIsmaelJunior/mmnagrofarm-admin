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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_commande')->unique();
            
            // Relation avec le client
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            
            // Informations de livraison (peuvent être différentes de celles du client)
            $table->text('adresse_livraison');
            $table->string('ville');
            $table->string('code_postal')->nullable();
            
            // Informations de la commande
            $table->json('produits'); // Array des produits commandés
            $table->integer('total_articles')->default(0);
            $table->decimal('montant_total', 10, 2)->nullable();
            $table->date('date_livraison_souhaitee')->nullable();
            $table->text('commentaires')->nullable();
            
            // Statut de la commande
            $table->enum('statut', ['en_attente', 'en_cours', 'livree', 'annulee'])->default('en_attente');
            $table->text('notes_admin')->nullable();
            
            // Soft deletes
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable();
            
            $table->timestamps();
            
            // Index pour les recherches
            $table->index(['statut', 'created_at']);
            $table->index('client_id');
            $table->index('numero_commande');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
