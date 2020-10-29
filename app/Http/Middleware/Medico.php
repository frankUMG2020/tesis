<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\clinica\seguridad\Rol;

class Medico
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $rol = Rol::find(Auth::user()->rol_id);
        if (mb_strtolower($rol->nombre) == 'médico')
        return redirect()->route('home')->with('info', '¡Usted no tiene autorización para realizar esta acción!');
        else
            return $next($request);
    }
}
