<?php

namespace App\Http\Middleware;

use Closure;

class Pelanggan
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
        if(auth()->user()->roles == 3 || auth()->user()->roles == 1){
            return $next($request);
        }
   
        return redirect('/error')->with("error","You don't have admin access.");
    }
}
