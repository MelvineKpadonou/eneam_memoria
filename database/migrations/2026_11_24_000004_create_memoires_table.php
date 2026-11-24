<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('memoires', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('resume')->nullable();
            $table->string('fichier_path');
            // soumis, en_verification, valide, rejete
            $table->string('statut')->default('soumis');
            $table->text('motif_rejet')->nullable();
            $table->boolean('acces_restreint')->default(false);
            $table->boolean('telechargement_autorise')->default(true);
            $table->date('date_embargo')->nullable();

            $table->foreignId('auteur_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('encadreur_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('filiere_id')->constrained('filieres')->restrictOnDelete();
            $table->foreignId('annee_academique_id')->constrained('annees_academiques')->restrictOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('memoires');
    }
};
