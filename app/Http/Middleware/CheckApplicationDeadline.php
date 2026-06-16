<?php
// app/Http/Middleware/CheckApplicationDeadline.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApplicationDeadline
{
    public function handle(Request $request, Closure $next): Response
    {
        $deadline = strtotime('2026-12-31 23:59:59');
        $now = time();
        
        if ($now > $deadline) {
            return redirect()->route('student.dashboard')->with('error', 'আবেদনের সময়সীমা শেষ হয়েছে।');
        }
        
        return $next($request);
    }
}