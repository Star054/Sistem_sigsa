<?php

namespace App\Http\Middleware;



use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Verificar si el usuario está autenticado y tiene el rol adecuado
        if (Auth::check() && Auth::user()->rol === $role) {
            return $next($request);
        }

        // Si no tiene el rol, redirigir al home o donde quieras
        return redirect()->route('home')->withErrors(['error' => 'No tienes permisos para acceder a esta página.']);
    }
}



