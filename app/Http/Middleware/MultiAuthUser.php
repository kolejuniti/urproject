<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class MultiAuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType): Response
    {

        if (Auth::check()) {
            if (Auth::user()->type == $userType) {
                return $next($request);
            }
            
            // Redirect based on user type
            switch (Auth::user()->type) {
                case 'user':
                    return redirect('/user/dashboard');
                case 'advisor':
                    return redirect('/advisor/dashboard');
                case 'admin':
                    return redirect('/admin/dashboard');
            }
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
