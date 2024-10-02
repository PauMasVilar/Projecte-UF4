<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRol
{
    // Aquesta funció ens permet al web.php, si li posem el middleware "hasPermission" (definit al Kernel.php)
    // Si l'usuari que accedeix a la ruta definida amb el middleware mirarà si està autentificar i si es admin
    // o professor, si no ho és no permetra accedir a la ruta i mostrarà el missatge 403...
    public function handle($request, Closure $next)
    {
        if (auth()->check() && (auth()->user()->is_admin || auth()->user()->is_professor)) {
            return $next($request);
        }

        abort(403, 'No tens permisos per accedir a aquesta pàgina');
    }
}
