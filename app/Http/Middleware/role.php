<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $jabatan): Response
    {
        if (Auth::check()) {
            $peran = explode('-', $jabatan);
            foreach ($peran as $group) {
                if (Auth::user()->role == $group){
                    return $next($request);
                }
            }
        }
        return redirect('/');
    }
}