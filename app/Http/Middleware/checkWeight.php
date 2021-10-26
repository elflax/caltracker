<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkWeight
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
        if(is_null(auth()->user()->weight))
        {
            return view('US6\weightregister');
        }
        return $next($request);
        
    }
}
