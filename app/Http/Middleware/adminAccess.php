<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class adminAccess
{
    /**
     * Handle an incoming request.
     * Check user if admin or not. Return a error message inview if not admin accessing the route.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * 
     *
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->is_admin==1){
            return $next($request);
        }else{
            return redirect('home')->with('error','Admin access only.');
        }
    }
}
