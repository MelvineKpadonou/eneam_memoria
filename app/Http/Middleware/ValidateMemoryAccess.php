<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ValidateMemoryAccess
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

        // Si l'utilisateur est un étudiant
        if ($user->role === 'etudiant') {
            // Vérifier si l'utilisateur a des mémoires en cours
            // Cette middleware peut être utilisé pour contrôler l'accès
            // aux mémoires non validés ou pour rediriger vers l'accueil
        }

        return $next($request);
    }
}
