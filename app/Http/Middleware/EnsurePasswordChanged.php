<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsurePasswordChanged
{
    /**
     * Fuerza a usuarios con must_change_password=true a cambiar la contraseña.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user->must_change_password) {
            $routeName = $request->route()?->getName();

            $allowed = [
                'perfil',
                'perfil.foto',
                'perfil.password',
                'perfil.password.update',
                'logout',
            ];

            if (!$routeName || !in_array($routeName, $allowed, true)) {
                return redirect()->route('perfil.password');
            }
        }

        return $next($request);
    }
}
