<?php

use App\Models\User;

test('la page de connexion se rend', function () {
    $this->get(route('login'))
        ->assertOk()
        ->assertSee('ENEAM');
});

test('le tableau de bord se rend pour un utilisateur connecte', function () {
    $user = new User([
        'nom' => 'Admin',
        'prenom' => 'Test',
        'matricule' => 'ADM-001',
        'email' => 'admin@example.test',
        'role' => 'admin',
    ]);

    $this->actingAs($user)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertSee('Tableau de bord');
});
