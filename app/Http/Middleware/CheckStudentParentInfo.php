<?php
// app/Http/Middleware/CheckStudentParentInfo.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckStudentParentInfo
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->isStudent()) {
            if (!$user->hasParentInfo()) {
                session(['url.intended' => $request->url()]);
                return redirect()->route('student.dashboard')
                    ->with('warning', 'অনুগ্রহ করে আপনার অভিভাবকের তথ্য প্রদান করুন।')
                    ->with('showParentModal', true);
            }
        }

        return $next($request);
    }
}
