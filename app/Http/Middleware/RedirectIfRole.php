<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response|RedirectResponse)  $next
     * @param  string[]  $roles
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (in_array($user->role, $roles, true)) {
            return $next($request);
        }

        // Rediriger vers la page d'accueil selon le rôle
        if ($user->role === 'etudiant') {
            return redirect()->route('welcome');
        }

        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        }

        if ($user->role === 'validateur') {
            return redirect()->route('validateur.index');
        }

        return redirect()->route('dashboard');
    }
}
