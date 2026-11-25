<?php

namespace App\Http\Controllers;

use App\Models\Memoire;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MemoireController extends Controller
{
    public function index(): View
    {
        return view('Memoires.index');
    }

    public function create(): View
    {
        return view('Memoires.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $donnees = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'resume' => ['nullable', 'string'],
            'fichier' => ['required', 'file', 'mimes:pdf', 'max:20480'],
            'filiere_id' => ['required', 'exists:filieres,id'],
            'annee_academique_id' => ['required', 'exists:annees_academiques,id'],
        ]);

        $chemin = $request->file('fichier')->store('memoires', 'local');

        Memoire::create([
            'titre' => $donnees['titre'],
            'resume' => $donnees['resume'] ?? null,
            'fichier_path' => $chemin,
            'filiere_id' => $donnees['filiere_id'],
            'annee_academique_id' => $donnees['annee_academique_id'],
            'auteur_id' => $request->user()->id,
        ]);

        return redirect()->route('memoires.index');
    }

    public function show(Memoire $memoire): View
    {
        return view('Memoires.show', ['memoire' => $memoire]);
    }

    public function edit(Memoire $memoire): View
    {
        return view('Memoires.edit', ['memoire' => $memoire]);
    }

    public function update(Memoire $memoire): RedirectResponse
    {
        return redirect()->route('memoires.index');
    }

    public function destroy(Memoire $memoire): RedirectResponse
    {
        return redirect()->route('memoires.index');
    }

    public function lire(Memoire $memoire): View
    {
        abort_unless($this->peutLire($memoire), 403);
        $this->abortSiFichierIntrouvable($memoire);

        return view('Memoires.lire', ['memoire' => $memoire]);
    }

    public function telecharger(Memoire $memoire): BinaryFileResponse
    {
        abort_unless($this->peutLire($memoire), 403);
        abort_unless($memoire->telechargement_autorise, 403);
        $this->abortSiFichierIntrouvable($memoire);

        return response()->download(
            Storage::disk('local')->path($memoire->fichier_path),
            'memoire.pdf',
            ['Content-Type' => 'application/pdf']
        );
    }

    public function fichier(Memoire $memoire): BinaryFileResponse
    {
        abort_unless($this->peutLire($memoire), 403);
        $this->abortSiFichierIntrouvable($memoire);

        return response()->file(
            Storage::disk('local')->path($memoire->fichier_path),
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="memoire.pdf"',
            ]
        );
    }

    public function mesMemoires(): View
    {
        return view('Memoires.mes-memoires');
    }

    private function abortSiFichierIntrouvable(Memoire $memoire): void
    {
        abort_unless(
            filled($memoire->fichier_path) && Storage::disk('local')->exists($memoire->fichier_path),
            404,
            'Le fichier de ce mémoire est introuvable.'
        );
    }

    private function peutLire(Memoire $memoire): bool
    {
        $user = auth()->user();

        if ($user === null) {
            return false;
        }

        if ((int) $user->id === (int) $memoire->auteur_id || in_array($user->role, ['validateur', 'admin'], true)) {
            return true;
        }

        $embargoTermine = $memoire->date_embargo === null
            || $memoire->date_embargo->lte(today());

        return $memoire->statut === 'valide' && $embargoTermine;
    }
}
