<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use App\Models\Memoire;
use App\Models\Filiere;
use App\Models\AnneeAcademique;
use App\Models\MotCle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MemoireController extends Controller
{
    // Catalogue des mémoires
    public function index(Request $request)
    {
        $memoires = Memoire::with(['auteur', 'filiere', 'anneeAcademique'])
            ->where('statut', 'valide')
            // ... filtres ...
            ->latest()
            ->paginate(9);

        return view('Etudiant.memoires.index', [ // ✅ VUE ÉTUDIANT
            'memoires' => $memoires,
            'filieres' => Filiere::orderBy('nom')->get(),
            'anneesAcademiques' => AnneeAcademique::orderByDesc('annee')->get(),
        ]);
    }

    // Fiche détaillée
    public function show(Memoire $memoire)
    {
        return view('Etudiant.memoires.show', ['memoire' => $memoire]); // ✅
    }

    // Formulaire de dépôt
    public function create()
    {
        return view('Etudiant.memoires.create', $this->donneesFormulaire()); // ✅
    }

    // Enregistrement
    public function store(Request $request)
    {
        $donnees = $request->validate($this->regles(creation: true));
        $chemin = $request->file('fichier')->store('memoires', 'local');

        $memoire = Memoire::create([
            'titre' => $donnees['titre'],
            'resume' => $donnees['resume'],
            'fichier_path' => $chemin,
            'filiere_id' => $donnees['filiere_id'],
            'annee_academique_id' => $donnees['annee_academique_id'],
            'encadreur_id' => $donnees['encadreur_id'] ?? null,
            'auteur_id' => auth()->id(),
            'statut' => 'soumis',
        ]);

        $memoire->motCles()->sync($donnees['mot_cles'] ?? []);

        return redirect()->route('memoires.mes')->with('success', 'Mémoire déposé.');
    }

    // Modification
    public function edit(Memoire $memoire)
    {
        return view('Etudiant.memoires.edit', $this->donneesFormulaire() + [
            'memoire' => $memoire->load('motCles'),
        ]);
    }

    public function update(Request $request, Memoire $memoire)
    {
        // ... logique de mise à jour ...
    }

    // Suppression
    public function destroy(Memoire $memoire)
    {
        // ... logique de suppression ...
    }

    // Mes mémoires
    public function mesMemoires()
    {
        $memoires = Memoire::where('auteur_id', auth()->id())->paginate(10);
        return view('Etudiant.memoires.mes-memoires', ['memoires' => $memoires]); // ✅
    }

    // Lecture en ligne
    public function lire(Memoire $memoire)
    {
        return view('Etudiant.memoires.lire', ['memoire' => $memoire]); // ✅
    }

    // Téléchargement
    public function telecharger(Memoire $memoire)
    {
        // ...
    }

    // Fichier PDF (pour PDF.js)
    public function fichier(Memoire $memoire)
    {
        // ...
    }

    // Méthodes privées
    private function regles(bool $creation): array { /* ... */ }
    private function donneesFormulaire(): array { /* ... */ }
}
