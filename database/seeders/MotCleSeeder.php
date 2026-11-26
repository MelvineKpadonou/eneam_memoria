<?php

namespace Database\Seeders;

use App\Models\MotCle;
use Illuminate\Database\Seeder; // N'oubliez pas d'importer le modèle !

class MotCleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Liste des mots-clés classés par thématique
        $motsCles = [
            // --- Thématique Informatique & Technologies ---
            'Développement web',
            'Laravel',
            'PHP',
            'Base de données',
            'MySQL',
            'Sécurité informatique',
            'Intelligence Artificielle',
            'Digitalisation',
            'Application mobile',
            'Système d\'information',
            'Réseaux',
            'Gestion de projet IT',

            // --- Thématique Administration & Gestion ---
            'Gestion des ressources humaines',
            'Comptabilité',
            'Audit',
            'Marketing digital',
            'Stratégie d\'entreprise',
            'Gestion financière',
            'Commerce électronique',
            'Management',
            'Entrepreneuriat',

            // --- Thématique Statistique & Analyse ---
            'Analyse de données',
            'Statistiques',
            'Data Science',
            'Modélisation',
            'Échantillonnage',
            'Prévisions',
            'Tableau de bord',

            // --- Thématique Éducation / Bibliothèque (Spécifique à votre projet) ---
            'Bibliothèque numérique',
            'Archivage',
            'Gestion documentaire',
            'Numérisation',
            'PDF',
        ];

        // Boucle pour insérer chaque mot-clé dans la base de données
        foreach ($motsCles as $libelle) {
            MotCle::create([
                'libelle' => $libelle,
            ]);
        }
    }
}
