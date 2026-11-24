<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adapte la table "users" de Laravel à la classe User du diagramme :
 * name devient nom, et on ajoute prenom, matricule, role, filiere_id.
 */
return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'nom');
        });

        Schema::table('users', function (Blueprint $table) {
            // nullable : pour ne pas bloquer les comptes déjà créés
            $table->string('prenom')->nullable();
            $table->string('matricule')->nullable()->unique();
            // etudiant, encadreur, validateur, admin
            $table->string('role')->default('etudiant');
            $table->foreignId('filiere_id')->nullable()->constrained('filieres')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('filiere_id');
            $table->dropColumn(['prenom', 'matricule', 'role']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('nom', 'name');
        });
    }
};
