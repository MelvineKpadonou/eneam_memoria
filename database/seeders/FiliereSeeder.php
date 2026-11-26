<?php

namespace Database\Seeders;

use App\Models\Filiere;
use Illuminate\Database\Seeder; // Assurez-vous que le modèle existe

class FiliereSeeder extends Seeder
{
    public function run(): void
    {
        Filiere::create(['nom' => 'Informatique de Gestion', 'code' => 'IG']);
        Filiere::create(['nom' => 'Gestion des Banques et Assurances', 'code' => 'GBA']);
        Filiere::create(['nom' => 'Statistique', 'code' => 'STAT']);
    }
}
