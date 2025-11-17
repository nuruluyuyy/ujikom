<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminSecretUrlMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $secret = config('app.admin_secret');
        
        // Jika secret tidak di-set atau tidak cocok, redirect ke halaman 404
        if (empty($secret) || $request->query('secret') !== $secret) {
            abort(404);
        }

        return $next($request);
    }
}
