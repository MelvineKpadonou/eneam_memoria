<?php

namespace App\Http\Controllers;

use App\Models\Memoire;
use Illuminate\Http\Request;

class FavoriController extends Controller
{
    public function index()
    {
        $memoires = Memoire::whereHas('favoris')->get();

        return response()->json($memoires);
    }

    public function create()
    {
        //
    }

    public function store(Request $request, Memoire $memoire)
    {
        $memoire->favoris()->create([
            'user_id' => auth()->id(),
        ]);

        return response()->json(['message' => 'Memoire ajoutée aux favoris']);
    }

    public function show(Memoire $memoire)
    {
        return response()->json($memoire->load('favoris'));
    }

    public function edit(Memoire $memoire)
    {
        //
    }

    public function update(Request $request, Memoire $memoire)
    {
        //
    }

    public function destroy(Memoire $memoire)
    {
        $memoire->favoris()->where('user_id', auth()->id())->delete();

        return response()->json(['message' => 'Memoire retirée des favoris']);
    }
}
