<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // On récupère uniquement les étudiants non vérifiés
        $usersEnAttente = User::where('role_verifie', false)
            ->whereIn('role', ['lecteur', 'auteur'])
            ->latest()
            ->paginate(15);

        return view('admin.users.index', compact('usersEnAttente'));
    }

    public function valider(User $user)
    {
        // L'admin valide le rôle déclaré
        $user->update(['role_verifie' => true]);

        return back()->with('success', "Le rôle de {$user->nom} {$user->prenom} a été validé.");
    }

    public function changerRole(Request $request, User $user)
    {
        // L'admin change le rôle (si l'étudiant a menti)
        $request->validate([
            'nouveau_role' => 'required|in:lecteur,auteur',
        ]);

        $user->update([
            'role' => $request->nouveau_role,
            'role_verifie' => true,
        ]);

        return back()->with('success', 'Rôle modifié et vérifié.');
    }
}
