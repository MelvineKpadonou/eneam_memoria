<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AdminAutorise;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Affiche le formulaire d'inscription.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Traite la demande d'inscription.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validation
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'matricule' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'role_demande' => 'required|in:lecteur,auteur',
        ]);

        $role = 'etudiant';
        $roleVerifie = false; // Par défaut, en attente de vérification

        // 2. Cas spécial : Admin ou Validateur (Whitelist)
        $autorisation = AdminAutorise::where('email', $request->email)->first();

        if ($autorisation) {
            $role = $autorisation->role; // 'admin' ou 'validateur'
            $roleVerifie = true; // Les admins sont vérifiés d'office
        } else {
            // 3. Cas Étudiant : on prend ce qu'il a déclaré
            $role = $request->role_demande; // 'lecteur' ou 'auteur'
            $roleVerifie = false; // En attente de vérification par l'admin
        }

        // 4. Création de l'utilisateur
        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'matricule' => $request->matricule,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
            'role_verifie' => $roleVerifie,
            'filiere_id' => $request->filiere_id ?? null,
        ]);

        return redirect()->route('login')
            ->with('success', 'Compte créé avec succès ! Un administrateur vérifiera votre rôle sous peu.');
    }
}
