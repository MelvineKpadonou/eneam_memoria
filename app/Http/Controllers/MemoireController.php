<?php

namespace App\Http\Controllers;

use App\Models\AnneeAcademique;
use App\Models\Consultation;
use App\Models\Filiere;
use App\Models\Memoire;
use App\Models\MotCle;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MemoireController extends Controller
{
    /* ------------------------------------------------------------------
     |  Catalogue
     * ------------------------------------------------------------------ */

    public function index(Request $request): View
    {
        $memoires = Memoire::with(['auteur', 'filiere', 'anneeAcademique'])
            ->where('statut', 'valide')
            ->when($request->q, function ($query, $mot) {
                $query->where(function ($q) use ($mot) {
                    $q->where('titre', 'like', "%{$mot}%")
                        ->orWhere('resume', 'like', "%{$mot}%")
                        ->orWhereHas('auteur', fn ($a) => $a->where('nom', 'like', "%{$mot}%")
                            ->orWhere('prenom', 'like', "%{$mot}%"))
                        ->orWhereHas('motCles', fn ($m) => $m->where('libelle', 'like', "%{$mot}%"));
                });
            })
            ->when($request->filiere_id, fn ($q, $id) => $q->where('filiere_id', $id))
            ->when($request->annee_academique_id, fn ($q, $id) => $q->where('annee_academique_id', $id))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('Etudiant.catalogue.index', [
            'memoires' => $memoires,
            'filieres' => Filiere::orderBy('nom')->get(),
            'anneesAcademiques' => AnneeAcademique::orderByDesc('annee')->get(),
        ]);
    }

    public function show(Memoire $memoire): View
    {
        abort_unless($this->peutVoirFiche($memoire), 403);

        $memoire->load(['auteur', 'encadreur', 'filiere', 'anneeAcademique', 'motCles']);

        return view('Etudiant.catalogue.show', ['memoire' => $memoire]);
    }

    /* ------------------------------------------------------------------
     |  Espace étudiant : dépôt, modification, suppression
     * ------------------------------------------------------------------ */

    public function mesMemoires(): View
    {
        $memoires = Memoire::with(['filiere', 'anneeAcademique'])
            ->where('auteur_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('Etudiant.memoires.mes-memoires', ['memoires' => $memoires]);
    }

    public function create(): View
    {
        $this->abortSiPasEtudiant();
        $user = auth()->user();

        if ($user->role !== 'auteur' || ! $user->role_verifie) {
            abort(403, 'Votre compte doit être vérifié avant de pouvoir déposer un mémoire.');
        }

        return view('Etudiant.memoires.create', $this->donneesFormulaire());

    }

    public function store(Request $request): RedirectResponse
    {
        $this->abortSiPasEtudiant();

        $donnees = $request->validate($this->regles(creation: true));

        $chemin = $request->file('fichier')->store('memoires', 'local');

        $memoire = Memoire::create([
            'titre' => $donnees['titre'],
            'resume' => $donnees['resume'],
            'fichier_path' => $chemin,
            'filiere_id' => $donnees['filiere_id'],
            'annee_academique_id' => $donnees['annee_academique_id'],
            'encadreur_id' => $donnees['encadreur_id'] ?? null,
            'auteur_id' => $request->user()->id,
            'statut' => 'soumis',
        ]);

        $memoire->motCles()->sync($donnees['mot_cles'] ?? []);

        return redirect()->route('memoires.mes')
            ->with('success', 'Mémoire déposé. Il sera examiné par un validateur.');

        // Vérification : l'utilisateur doit être un auteur VÉRIFIÉ
        $user = auth()->user();

        if ($user->role !== 'auteur' || ! $user->role_verifie) {
            return redirect()->route('memoires.mes')
                ->with('error', 'Votre compte doit être vérifié par un administrateur avant de pouvoir déposer un mémoire.');
        }

    }

    public function edit(Memoire $memoire): View
    {
        $this->abortSiNonModifiable($memoire);

        return view('Etudiant.memoires.edit', $this->donneesFormulaire() + [
            'memoire' => $memoire->load('motCles'),
        ]);
    }

    public function update(Request $request, Memoire $memoire): RedirectResponse
    {
        $this->abortSiNonModifiable($memoire);

        $donnees = $request->validate($this->regles(creation: false));

        $champs = [
            'titre' => $donnees['titre'],
            'resume' => $donnees['resume'],
            'filiere_id' => $donnees['filiere_id'],
            'annee_academique_id' => $donnees['annee_academique_id'],
            'encadreur_id' => $donnees['encadreur_id'] ?? null,
            // Resoumission : le mémoire repart en examen
            'statut' => 'soumis',
            'motif_rejet' => null,
        ];

        if ($request->hasFile('fichier')) {
            Storage::disk('local')->delete($memoire->fichier_path);
            $champs['fichier_path'] = $request->file('fichier')->store('memoires', 'local');
        }

        $memoire->update($champs);
        $memoire->motCles()->sync($donnees['mot_cles'] ?? []);

        return redirect()->route('memoires.mes')->with('success', 'Mémoire resoumis.');
    }

    public function destroy(Memoire $memoire): RedirectResponse
    {
        $this->abortSiNonModifiable($memoire);

        Storage::disk('local')->delete($memoire->fichier_path);
        $memoire->motCles()->detach();
        $memoire->delete();

        return redirect()->route('memoires.mes')->with('success', 'Mémoire supprimé.');
    }

    /* ------------------------------------------------------------------
     |  Lecture en ligne (PDF.js) et téléchargement
     * ------------------------------------------------------------------ */

    public function lire(Memoire $memoire): View
    {
        abort_unless($this->peutLire($memoire), 403);
        $this->abortSiFichierIntrouvable($memoire);

        // Une seule consultation par ouverture de la page (pas à chaque requête du PDF)
        Consultation::create([
            'user_id' => auth()->id(),
            'memoire_id' => $memoire->id,
            'date_lecture' => now(),
        ]);

        return view('Memoires.lire', ['memoire' => $memoire]);
    }

    public function telecharger(Memoire $memoire): BinaryFileResponse
    {
        abort_unless($this->peutLire($memoire), 403);
        abort_unless(
            $memoire->telechargement_autorise || $this->estAuteur($memoire) || $this->estValidateurOuAdmin(),
            403
        );
        $this->abortSiFichierIntrouvable($memoire);

        return response()->download(
            Storage::disk('local')->path($memoire->fichier_path),
            Str::slug($memoire->titre).'.pdf',
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
                'Content-Disposition' => 'inline; filename="'.Str::slug($memoire->titre).'.pdf"',
            ]
        );
    }

    /* ------------------------------------------------------------------
     |  Méthodes privées
     * ------------------------------------------------------------------ */

    private function regles(bool $creation): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'resume' => ['required', 'string', 'min:50'],
            'fichier' => [$creation ? 'required' : 'nullable', 'file', 'mimes:pdf', 'max:20480'],
            // exists:Modèle,id : Laravel retrouve tout seul le nom réel de la table
            'filiere_id' => ['required', 'exists:'.Filiere::class.',id'],
            'annee_academique_id' => ['required', 'exists:'.AnneeAcademique::class.',id'],
            'encadreur_id' => ['nullable', Rule::exists(User::class, 'id')->where('role', 'encadreur')],
            'mot_cles' => ['nullable', 'array'],
            'mot_cles.*' => ['exists:'.MotCle::class.',id'],
        ];
    }

    private function donneesFormulaire(): array
    {
        return [
            'filieres' => Filiere::orderBy('nom')->get(),
            'anneesAcademiques' => AnneeAcademique::orderByDesc('annee')->get(),
            'motCles' => MotCle::orderBy('libelle')->get(),
            'encadreurs' => User::where('role', 'encadreur')->orderBy('nom')->get(),
        ];
    }

    private function abortSiPasEtudiant(): void
    {
        abort_unless(auth()->user()?->role === 'etudiant', 403, 'Seuls les étudiants peuvent déposer un mémoire.');
    }

    private function abortSiNonModifiable(Memoire $memoire): void
    {
        abort_unless($this->estAuteur($memoire), 403);
        abort_if($memoire->statut === 'valide', 403, 'Un mémoire validé ne peut plus être modifié ni supprimé.');
    }

    private function abortSiFichierIntrouvable(Memoire $memoire): void
    {
        abort_unless(
            filled($memoire->fichier_path) && Storage::disk('local')->exists($memoire->fichier_path),
            404,
            'Le fichier de ce mémoire est introuvable.'
        );
    }

    private function estAuteur(Memoire $memoire): bool
    {
        return (int) auth()->id() === (int) $memoire->auteur_id;
    }

    private function estEncadreur(Memoire $memoire): bool
    {
        return $memoire->encadreur_id !== null && (int) auth()->id() === (int) $memoire->encadreur_id;
    }

    private function estValidateurOuAdmin(): bool
    {
        return in_array(auth()->user()?->role, ['validateur', 'admin'], true);
    }

    /** La fiche est visible si le mémoire est validé, ou si on y est lié (auteur, encadreur, validateur, admin). */
    private function peutVoirFiche(Memoire $memoire): bool
    {
        return $memoire->statut === 'valide'
            || $this->estAuteur($memoire)
            || $this->estEncadreur($memoire)
            || $this->estValidateurOuAdmin();
    }

    private function peutLire(Memoire $memoire): bool
    {
        $user = auth()->user();

        if ($user === null) {
            return false;
        }

        if ($this->estAuteur($memoire) || $this->estEncadreur($memoire) || $this->estValidateurOuAdmin()) {
            return true;
        }

        if ($memoire->statut !== 'valide') {
            return false;
        }

        // Embargo : nécessite le cast 'date' sur date_embargo dans le modèle Memoire
        if ($memoire->date_embargo !== null && $memoire->date_embargo->gt(today())) {
            return false;
        }

        // Accès restreint : réservé aux étudiants de la même filière
        if ($memoire->acces_restreint) {
            return $user->filiere_id !== null && (int) $user->filiere_id === (int) $memoire->filiere_id;
        }

        return true;
    }
}
