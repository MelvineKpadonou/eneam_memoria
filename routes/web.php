<?php

use App\Http\Controllers\AnneeAcademiqueController;
use App\Http\Controllers\FavoriController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\MemoireController;
use App\Http\Controllers\MotCleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidateurController;
use App\Http\Controllers\ValidationMemoireController;
use Illuminate\Support\Facades\Route;

// 1. Page d'accueil pour les VISITEURS (non connectés)
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('memoires.index')
        : view('home');
})->name('home');

// 2. Routes pour les utilisateurs CONNECTÉS
Route::middleware(['auth', 'CheckStudentProfile'])->group(function () {

    // Page d'accueil après connexion (étudiants)
    Route::get('/welcome', function () {
        return view('welcome'); // welcome.blade.php est la page connectée
    })->name('welcome');

    Route::resource('memoires', MemoireController::class);
    Route::get('/memoires/{memoire}/lire', [MemoireController::class, 'lire'])->name('memoires.lire');
    Route::get('/memoires/{memoire}/telecharger', [MemoireController::class, 'telecharger'])->name('memoires.telecharger');
    Route::get('/memoires/{memoire}/fichier', [MemoireController::class, 'fichier'])->name('memoires.fichier');
    Route::get('/mes-memoires', [MemoireController::class, 'mesMemoires'])->name('memoires.mes');

    Route::get('/favoris', [FavoriController::class, 'index'])->name('favoris.index');
    Route::post('/favoris/{memoire}', [FavoriController::class, 'store'])->name('favoris.store');
    Route::delete('/favoris/{memoire}', [FavoriController::class, 'destroy'])->name('favoris.destroy');
    Route::get('/historique', [HistoriqueController::class, 'index'])->name('historique.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'RedirectIfRole:validateur'])->prefix('validateur')->name('validateur.')->group(function () {
    Route::get('/', [ValidateurController::class, 'index'])->name('index');
    Route::get('/memoires/{memoire}', [ValidationMemoireController::class, 'show'])->name('show');
    Route::post('/memoires/{memoire}/prendre', [ValidationMemoireController::class, 'prendreEnCharge'])->name('prendre');
    Route::post('/memoires/{memoire}/valider', [ValidationMemoireController::class, 'valider'])->name('valider');
    Route::post('/memoires/{memoire}/rejeter', [ValidationMemoireController::class, 'rejeter'])->name('rejeter');
});

Route::middleware(['auth', 'RedirectIfRole:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/valider', [UserController::class, 'valider'])->name('users.valider');
    Route::patch('/users/{user}/changer-role', [UserController::class, 'changerRole'])->name('users.changerRole');
    Route::resource('filieres', FiliereController::class);
    Route::resource('annees', AnneeAcademiqueController::class);
    Route::resource('mots-cles', MotCleController::class);
    Route::get('/statistiques', [StatistiqueController::class, 'index'])->name('statistiques');
});

require __DIR__.'/auth.php';
