<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $adminUser = $request->user();
        if (!$adminUser || $adminUser->role !== 'admin') {

            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Unauthorized access'], 403);
            }


            return redirect()->route('admin.login')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}
