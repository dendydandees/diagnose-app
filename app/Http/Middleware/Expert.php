<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Expert
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->user()->hasRole('expert')){
            return(redirect('/dashboard'));
        }

        return $next($request);
    }
}
