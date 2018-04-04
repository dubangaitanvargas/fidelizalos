<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class authNegocio

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
        
        if (auth()->check() && auth()->user()->Negocios_idNegocios > 0) {
            return $next($request);
        }
        return redirect('/selectNego');
        
        //var_dump($request->user()->Negocios_idNegocios);exit();
    }
}
