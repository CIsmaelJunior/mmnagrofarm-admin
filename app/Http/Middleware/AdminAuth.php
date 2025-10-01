<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            // Rediriger vers la page de connexion avec l'URL demandée
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        // Vérifier si la session est valide
        if (!$request->session()->has('login_web_' . sha1(Auth::getDefaultDriver()))) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Votre session a expiré. Veuillez vous reconnecter.');
        }

        // Vérifier l'activité récente (optionnel - pour plus de sécurité)
        $lastActivity = $request->session()->get('last_activity');
        $timeout = config('session.lifetime', 120) * 60; // en secondes

        if ($lastActivity && (time() - $lastActivity) > $timeout) {
            Auth::logout();
            $request->session()->invalidate();
            return redirect()->route('login')->with('error', 'Votre session a expiré par inactivité.');
        }

        // Mettre à jour l'activité
        $request->session()->put('last_activity', time());

        return $next($request);
    }
}
