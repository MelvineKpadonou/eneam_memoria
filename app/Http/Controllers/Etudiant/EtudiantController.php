<?php

namespace App\Http\Controllers\Etudiant;

use App\Models\User;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index()
    {
        $etudiants = User::where('role', 'etudiant')
            ->withCount('memoires')
            ->get();

        return response()->json($etudiants);
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

    public function show(User $etudiant)
    {
        return response()->json($etudiant->load('memoires'));
    }

    public function edit(User $etudiant)
    {
        //
    }

    public function update(Request $request, User $etudiant)
    {
        $validated = $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'prenom' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255',
            'filiere_id' => 'sometimes|exists:filieres,id',
        ]);

        $etudiant->update($validated);

        return response()->json($etudiant);
    }

    public function destroy(User $etudiant)
    {
        $etudiant->delete();

        return response()->json(['message' => 'Etudiant supprimé avec succès']);
    }
}
