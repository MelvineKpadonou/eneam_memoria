<?php

namespace App\Http\Controllers;

use App\Models\Memoire;
use Illuminate\Http\Request;

class MemoireController extends Controller
{
    public function index()
    {
        $memoires = Memoire::with(['etudiant', 'filiere', 'anneeAcademique'])->get();

        return response()->json($memoires);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'resume' => 'required|string',
            'contenu' => 'required|string',
            'filiere_id' => 'exists:filieres,id',
            'annee_academique_id' => 'exists:annee_academiques,id',
            'etudiant_id' => 'exists:users,id',
        ]);

        $memoire = Memoire::create($validated);

        return response()->json($memoire, 201);
    }

    public function show(Memoire $memoire)
    {
        return response()->json($memoire->load(['etudiant', 'filiere', 'anneeAcademique']));
    }

    public function edit(Memoire $memoire)
    {
        //
    }

    public function update(Request $request, Memoire $memoire)
    {
        $validated = $request->validate([
            'titre' => 'sometimes|required|string|max:255',
            'resume' => 'sometimes|required|string',
            'contenu' => 'sometimes|required|string',
            'filiere_id' => 'sometimes|exists:filieres,id',
            'annee_academique_id' => 'sometimes|exists:annee_academiques,id',
            'etudiant_id' => 'sometimes|exists:users,id',
        ]);

        $memoire->update($validated);

        return response()->json($memoire);
    }

    public function destroy(Memoire $memoire)
    {
        $memoire->delete();

        return response()->json(['message' => 'Memoire supprimée avec succès']);
    }
}
