<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }
        $previousUrl = url()->previous();
        // return redirect()->route($previousUrl)->with('error', 'Access denied.');
        return back()->withErrors(['error' => 'Access denied!'])->withInput();
    }
}
