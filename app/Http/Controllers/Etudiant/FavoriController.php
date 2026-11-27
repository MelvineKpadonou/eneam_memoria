<?php

namespace App\Http\Controllers\Etudiant;

use App\Models\Favori;
use App\Models\Memoire;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FavoriController extends Controller
{
    public function index(): View
    {
        return view('Favoris.index');
    }

    public function store(Request $request, Memoire $memoire): RedirectResponse
    {
        Favori::firstOrCreate([
            'user_id' => $request->user()->id,
            'memoire_id' => $memoire->id,
        ]);

        return redirect()->route('favoris.index');
    }

    public function destroy(Request $request, Memoire $memoire): RedirectResponse
    {
        Favori::where('user_id', $request->user()->id)
            ->where('memoire_id', $memoire->id)
            ->delete();

        return redirect()->route('favoris.index');
    }
}
