<?php

namespace Database\Seeders;

use App\Models\AdminAutorise;
use Illuminate\Database\Seeder;

class AdminAutoriseSeeder extends Seeder
{
    public function run(): void
    {
        // Le responsable de la bibliothèque
        AdminAutorise::create([
            'email' => 'bibliotheque@eneam.bj',
            'role' => 'admin',
        ]);

        // Un validateur de la filière Informatique
        AdminAutorise::create([
            'email' => 'validateur.ig@eneam.bj',
            'role' => 'validateur',
        ]);

        // Un validateur de la filière Administration
        AdminAutorise::create([
            'email' => 'validateur.adm@eneam.bj',
            'role' => 'validateur',
        ]);
    }
}
