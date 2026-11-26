<?php

namespace Database\Seeders;

use App\Models\AnneeAcademique;
use Illuminate\Database\Seeder;

class AnneeAcademiqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        AnneeAcademique::create(['annee' => '2025']);
        AnneeAcademique::create(['annee' => '2026']);
    }
}
