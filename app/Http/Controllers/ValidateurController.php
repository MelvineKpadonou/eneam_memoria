<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ValidateurController extends Controller
{
    public function index()
    {
        $validateurs = User::where('role', 'validateur')
            ->withCount('validations')
            ->get();

        return response()->json($validateurs);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $validateur)
    {
        return response()->json($validateur->load('validations'));
    }

    public function edit(User $validateur)
    {
        //
    }

    public function update(Request $request, User $validateur)
    {
        //
    }

    public function destroy(User $validateur)
    {
        $validateur->delete();

        return response()->json(['message' => 'Validateur supprimé avec succès']);
    }
}
