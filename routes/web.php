<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController, MemoireController, MotCleController,
    AnneeAcademiqueController, FiliereController, FavoriController,
    HistoriqueController, ValidateurController, ValidationMemoireController,
    UserController, StatistiqueController
};

// ---------- Pages accessibles sans connexion ----------
// (la connexion et l'inscription sont dans routes/auth.php si tu utilises Breeze)
Route::get('/', function () {
    return redirect()->route('memoires.index');
});

// ---------- Il faut être connecté ----------
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Catalogue : liste, fiche, dépôt, modification, suppression
    Route::resource('memoires', MemoireController::class);

    // Lecture en ligne (PDF.js) et téléchargement
    Route::get('/memoires/{memoire}/lire', [MemoireController::class, 'lire'])->name('memoires.lire');
    Route::get('/memoires/{memoire}/telecharger', [MemoireController::class, 'telecharger'])->name('memoires.telecharger');

    // Mes dépôts (suivi du statut côté étudiant)
    Route::get('/mes-memoires', [MemoireController::class, 'mesMemoires'])->name('memoires.mes');

    // Favoris et historique de lecture
    Route::get('/favoris', [FavoriController::class, 'index'])->name('favoris.index');
    Route::post('/favoris/{memoire}', [FavoriController::class, 'store'])->name('favoris.store');
    Route::delete('/favoris/{memoire}', [FavoriController::class, 'destroy'])->name('favoris.destroy');
    Route::get('/historique', [HistoriqueController::class, 'index'])->name('historique.index');
});

// ---------- Validateur (et admin) ----------
Route::middleware(['auth'])->prefix('validateur')->name('validateur.')->group(function () {
    Route::get('/', [ValidateurController::class, 'index'])->name('index');
    Route::get('/memoires/{memoire}', [ValidationMemoireController::class, 'show'])->name('show');
    Route::post('/memoires/{memoire}/prendre', [ValidationMemoireController::class, 'prendreEnCharge'])->name('prendre');
    Route::post('/memoires/{memoire}/valider', [ValidationMemoireController::class, 'valider'])->name('valider');
    Route::post('/memoires/{memoire}/rejeter', [ValidationMemoireController::class, 'rejeter'])->name('rejeter');
});

// ---------- Administrateur ----------
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('filieres', FiliereController::class);
    Route::resource('annees', AnneeAcademiqueController::class);
    Route::resource('mots-cles', MotCleController::class);
    Route::get('/statistiques', [StatistiqueController::class, 'index'])->name('statistiques');
});
