<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;

// class AdminMiddleware
// {
//     public function handle(Request $request, Closure $next)
//     {
//         // Check if user is logged in and has admin role
//         if (auth()->check() && auth()->user()->role === 'admin') {
//             return $next($request);
//         }

//         // Redirect with error if not admin
//         return redirect('/')->with('error', 'Access denied. Admin only.');
//     }
// }  

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;

// class AdminMiddleware
// {
//     public function handle(Request $request, Closure $next)
//     {
//         if (!auth()->check() || auth()->user()->role !== 'admin') {
//             abort(403, 'Unauthorized access.');
//         }

//         return $next($request);
//     }
// }

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;

// class AdminMiddleware
// {
//     public function handle(Request $request, Closure $next)
//     {
//         if (!auth()->check() || auth()->user()->role !== 'admin') {
//             return redirect('/')->with('error', 'Unauthorized access');
//         }
        
//         return $next($request);
//     }
// // }


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403);
        }

        return $next($request);
    }
}