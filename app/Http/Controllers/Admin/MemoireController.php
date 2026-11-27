<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Memoire;
use App\Models\Filiere;
use App\Models\AnneeAcademique;
use Illuminate\Http\Request;

class MemoireController extends Controller
{
    // Liste de tous les mémoires (avec filtres)
    public function index(Request $request)
    {
        $memoires = Memoire::with(['auteur', 'filiere', 'anneeAcademique'])
            // ... filtres ...
            ->latest()
            ->paginate(15);

        return view('Admin.Memoires.index', [ // ✅ VUE ADMIN
            'memoires' => $memoires,
            'filieres' => Filiere::orderBy('nom')->get(),
            'anneesAcademiques' => AnneeAcademique::orderByDesc('annee')->get(),
        ]);
    }

    // Fiche détaillée (vue admin avec boutons de validation)
    public function show(Memoire $memoire)
    {
        return view('Admin.Memoires.show', ['memoire' => $memoire]); // ✅
    }

    // Valider un mémoire
    public function valider(Memoire $memoire)
    {
        $memoire->update(['statut' => 'valide']);
        return back()->with('success', 'Mémoire validé.');
    }

    // Rejeter un mémoire
    public function rejeter(Request $request, Memoire $memoire)
    {
        $request->validate(['motif' => 'required|string']);
        $memoire->update([
            'statut' => 'rejete',
            'motif_rejet' => $request->motif,
        ]);
        return back()->with('success', 'Mémoire rejeté.');
    }

    // Lecture en ligne (pour l'admin)
    public function lire(Memoire $memoire)
    {
        return view('Admin.Memoires.lire', ['memoire' => $memoire]); // ✅
    }
}
