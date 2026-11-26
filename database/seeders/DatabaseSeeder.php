<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. On lance d'abord les référentiels de base (Filières, Années, Mots-clés)
        // L'ordre est important car les utilisateurs ont besoin des filières.
        $this->call([
            AdminAutoriseSeeder::class,
            FiliereSeeder::class,
            MotCleSeeder::class,
            AnneeAcademiqueSeeder::class, // Décommentez si vous l'avez créé
        ]);

        // 2. On crée les utilisateurs de test
        // On remplace 'name' par 'nom', 'prenom', et on ajoute les champs obligatoires

        User::factory()->create([
            'nom' => 'Test',
            'prenom' => 'User',
            'email' => 'test@example.com',
            'role' => 'etudiant',
            'matricule' => '12345678',
        ]);

        // Vous pouvez aussi appeler votre UserSeeder personnalisé si vous en avez un
        // $this->call(UserSeeder::class);
    }
}
