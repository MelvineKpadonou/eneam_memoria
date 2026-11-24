<?php

namespace App\Http\Controllers;

use App\Models\ValidationMemoire;
use Illuminate\Http\Request;

class HistoriqueController extends Controller
{
    public function index()
    {
        $historique = ValidationMemoire::with(['memoire', 'validateur'])
            ->latest('date_decision')
            ->get();

        return response()->json($historique);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'memoire_id' => 'required|exists:memoires,id',
            'validateur_id' => 'required|exists:users,id',
            'decision' => 'required|string|max:500',
            'motif' => 'required|string|max:500',
            'date_decision' => 'required|date',
        ]);

        $validation = ValidationMemoire::create($validated);

        return response()->json($validation, 201);
    }

    public function show(ValidationMemoire $validationMemoire)
    {
        return response()->json($validationMemoire->load(['memoire', 'validateur']));
    }

    public function edit(ValidationMemoire $validationMemoire)
    {
        //
    }

    public function update(Request $request, ValidationMemoire $validationMemoire)
    {
        $validated = $request->validate([
            'decision' => 'sometimes|required|string|max:500',
            'motif' => 'sometimes|required|string|max:500',
            'date_decision' => 'sometimes|required|date',
        ]);

        $validationMemoire->update($validated);

        return response()->json($validationMemoire);
    }

    public function destroy(ValidationMemoire $validationMemoire)
    {
        $validationMemoire->delete();

        return response()->json(['message' => 'Validation supprimée avec succès']);
    }
}
