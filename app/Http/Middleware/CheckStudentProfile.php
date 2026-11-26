<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckStudentProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response|RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();

        // Vérifier le profil uniquement pour les étudiants
        if ($user->role === 'etudiant' && ! $user->role_verifie) {
            // Vérifier si des champs obligatoires sont manquants
            $hasMissingFields = false;

            if (empty($user->matricule)) {
                $hasMissingFields = true;
            }
            if (empty($user->filiere_id)) {
                $hasMissingFields = true;
            }

            if ($hasMissingFields) {
                // Rediriger vers le profil pour le compléter
                return redirect()->route('profile.edit')
                    ->with('warning', 'Veuillez compléter votre profil étudiant avant de continuer.');
            }
        }

        return $next($request);
    }
}
