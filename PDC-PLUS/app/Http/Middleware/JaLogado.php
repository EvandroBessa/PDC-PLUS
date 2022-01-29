<?php

namespace App\Http\Middleware;

use Closure;

class JaLogado
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
        if(session()->has('id') && (url('entrar')==$request->url() || url('registo')==$request->url())){
            return redirect()->back();
        }
        return $next($request);
    }
}
