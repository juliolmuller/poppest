<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class VerifyAppToken
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('X-TIMESTAMP') && $request->hasHeader('X-TOKEN')) {
            if (md5($request->header('X-TIMESTAMP') . env('APP_KEY')) === $request->header('X-TOKEN')) {
                return $next($request);
            }
            return response()->json([
                'error' => 'Not match',
                'ts' => $request->header('X-TIMESTAMP'),
                'token' => $request->header('X-TOKEN'),
            ], 403);
        }
        return response()->json([
            'error' => 'Request does not contain the validation token',
        ], 403);
    }
}
