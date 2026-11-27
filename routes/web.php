<?php

// ==========================================
// IMPORTS DES CONTRÔLEURS
// ==========================================

// Contrôleurs Admin
use App\Http\Controllers\Admin\AnneeAcademiqueController as AdminAnneeAcademiqueController;
use App\Http\Controllers\Admin\FiliereController as AdminFiliereController;
use App\Http\Controllers\MotCleController;
use App\Http\Controllers\Admin\StatistiqueController as AdminStatistiqueController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ValidateurController as AdminValidateurController;
use App\Http\Controllers\Admin\ValidationMemoireController as AdminValidationMemoireController;
use App\Http\Controllers\Admin\MemoireController as AdminMemoireController;

// Contrôleurs Étudiant
use App\Http\Controllers\Etudiant\FavoriController as EtudiantFavoriController;
use App\Http\Controllers\Etudiant\HistoriqueController as EtudiantHistoriqueController;
use App\Http\Controllers\Etudiant\MemoireController as EtudiantMemoireController;

// Contrôleur commun
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

// ==========================================
// 1. PAGE D'ACCUEIL (VISITEURS)
// ==========================================
Route::get('/', function () {
    return view('home');
})->name('home');

// ==========================================
// 2. ROUTES ÉTUDIANT (Connectés)
// ==========================================
Route::middleware(['auth', 'CheckStudentProfile'])->group(function () {

    // Page d'accueil après connexion
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');

    // --- MÉMOIRES ---
    Route::get('/memoires', [EtudiantMemoireController::class, 'index'])->name('memoires.index');
    Route::get('/memoires/create', [EtudiantMemoireController::class, 'create'])->name('memoires.create');
    Route::post('/memoires', [EtudiantMemoireController::class, 'store'])->name('memoires.store');
    Route::get('/memoires/{memoire}', [EtudiantMemoireController::class, 'show'])->name('memoires.show');
    Route::get('/memoires/{memoire}/edit', [EtudiantMemoireController::class, 'edit'])->name('memoires.edit');
    Route::put('/memoires/{memoire}', [EtudiantMemoireController::class, 'update'])->name('memoires.update');
    Route::delete('/memoires/{memoire}', [EtudiantMemoireController::class, 'destroy'])->name('memoires.destroy');

    // Routes spécifiques étudiant
    Route::get('/mes-memoires', [EtudiantMemoireController::class, 'mesMemoires'])->name('memoires.mes');
    Route::get('/memoires/{memoire}/lire', [EtudiantMemoireController::class, 'lire'])->name('memoires.lire');
    Route::get('/memoires/{memoire}/telecharger', [EtudiantMemoireController::class, 'telecharger'])->name('memoires.telecharger');
    Route::get('/memoires/{memoire}/fichier', [EtudiantMemoireController::class, 'fichier'])->name('memoires.fichier');

    // --- FAVORIS & HISTORIQUE ---
    Route::get('/favoris', [EtudiantFavoriController::class, 'index'])->name('favoris.index');
    Route::post('/favoris/{memoire}', [EtudiantFavoriController::class, 'store'])->name('favoris.store');
    Route::delete('/favoris/{memoire}', [EtudiantFavoriController::class, 'destroy'])->name('favoris.destroy');
    Route::get('/historique', [EtudiantHistoriqueController::class, 'index'])->name('historique.index');

    // --- PROFIL ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// 3. ROUTES VALIDATEUR
// ==========================================
Route::middleware(['auth', 'role:validateur'])->prefix('validateur')->name('validateur.')->group(function () {
    Route::get('/', [AdminValidateurController::class, 'index'])->name('index');
    Route::get('/memoires/{memoire}', [AdminValidationMemoireController::class, 'show'])->name('show');
    Route::post('/memoires/{memoire}/prendre', [AdminValidationMemoireController::class, 'prendreEnCharge'])->name('prendre');
    Route::post('/memoires/{memoire}/valider', [AdminValidationMemoireController::class, 'valider'])->name('valider');
    Route::post('/memoires/{memoire}/rejeter', [AdminValidationMemoireController::class, 'rejeter'])->name('rejeter');
});

// ==========================================
// 4. ROUTES ADMIN
// ==========================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // --- TABLEAU DE BORD ADMIN (CORRIGÉ) ---
    // Le middleware 'auth' est déjà appliqué par le groupe parent, pas besoin de le remettre.
    Route::get('/dashboard', function () {
        return view('dashbord'); // ou 'dashboard' selon le nom exact de votre fichier
    })->name('dashboard');

    // --- MÉMOIRES (ADMIN) ---
    Route::get('/memoires', [AdminMemoireController::class, 'index'])->name('memoires.index');
    Route::get('/memoires/{memoire}', [AdminMemoireController::class, 'show'])->name('memoires.show');
    Route::post('/memoires/{memoire}/valider', [AdminMemoireController::class, 'valider'])->name('memoires.valider');
    Route::post('/memoires/{memoire}/rejeter', [AdminMemoireController::class, 'rejeter'])->name('memoires.rejeter');
    Route::get('/memoires/{memoire}/lire', [AdminMemoireController::class, 'lire'])->name('memoires.lire');

    // --- GESTION DES UTILISATEURS ---
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/valider', [AdminUserController::class, 'valider'])->name('users.valider');
    Route::patch('/users/{user}/changer-role', [AdminUserController::class, 'changerRole'])->name('users.changerRole');

    // --- RÉFÉRENTIELS ---
    Route::resource('filieres', AdminFiliereController::class);
    Route::resource('annees', AdminAnneeAcademiqueController::class);
    Route::resource('mots-cles', MotCleController::class); 

    // --- STATISTIQUES ---
    Route::get('/statistiques', [AdminStatistiqueController::class, 'index'])->name('statistiques');
});

require __DIR__.'/auth.php';
