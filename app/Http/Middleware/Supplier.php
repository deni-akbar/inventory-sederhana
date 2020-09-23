<?php

namespace App\Http\Middleware;

use Closure;

class Supplier
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
        if(auth()->user()->roles == 2 || auth()->user()->roles == 1){
            return $next($request);
        }
   
        return redirect('/error')->with("error","You don't have admin access.");
    }
}
