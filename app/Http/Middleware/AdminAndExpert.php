<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAndExpert
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
        if(!auth()->user()->hasAnyRole(['admin', 'expert'])){
            return(redirect('/dashboard'));
        }

        return $next($request);
    }
}
