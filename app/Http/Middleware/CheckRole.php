<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();
        if (!$user || !$user->role || !in_array($user->role->libelle, $roles)) {
            return redirect()->route('dashboard')->with([
                'showErrorModal' => true,
                'errorTitle' => 'Accès non autorisée',
                'errorMessage' => 'Vous n\'avez pas les permissions nécessaires pour accéder à cette page.',
            ]);
        }
        return $next($request);
    }
}
