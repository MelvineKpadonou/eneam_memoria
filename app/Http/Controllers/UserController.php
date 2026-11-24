<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['filiere'])->get();

        return response()->json($users);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'matricule' => 'required|string|max:255|unique:users,matricule',
            'email' => 'required|string|email|max:255|unique:users,email',
            'role' => 'required|string',
            'filiere_id' => 'exists:filieres,id',
        ]);

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    public function show(User $user)
    {
        return response()->json($user->load('filiere'));
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'prenom' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255',
            'filiere_id' => 'sometimes|exists:filieres,id',
        ]);

        $user->update($validated);

        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'Utilisateur supprimé avec succès']);
    }
}
