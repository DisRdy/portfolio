<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Content Security Policy
        // Allow scripts from self and Vite (unsafe-eval is needed for Vite dev server sometimes, but try strict first)
        // Allow fonts from Google Fonts
        // Allow styles from Google Fonts and Self (unsafe-inline needed for some dynamic styles if any, trying strict first)

        $csp = "default-src 'self'; " .
            "script-src 'self' 'unsafe-eval'; " . // unsafe-eval often needed for Vite HMR
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; " . // unsafe-inline often needed for style attributes / component libraries
            "font-src 'self' https://fonts.gstatic.com; " .
            "img-src 'self' data:; " .
            "connect-src 'self';";

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
