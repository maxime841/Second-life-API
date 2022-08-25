<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsManagerDj
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            auth()->user()->role->libelle == 'root' ||
            auth()->user()->role->libelle == 'admin' ||
            auth()->user()->role->libelle == 'managerclub' ||
            auth()->user()->role->libelle == 'managerdj'
        ) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}