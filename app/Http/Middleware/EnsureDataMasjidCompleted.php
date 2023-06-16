<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureDataMasjidCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->masjid == null) {
            flash('Data Masjid belum lengkap, silahkan lengkapi data masjid terlebih dahhulu')->error();
            return redirect()->route('masjid.create');
        }
        return $next($request);
    }
}