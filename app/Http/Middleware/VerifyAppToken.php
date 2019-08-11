<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\Tokenizer;

class VerifyAppToken
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('X-TIMESTAMP') && $request->hasHeader('X-TOKEN')) {
            if (Tokenizer::isExpired($request->header('X-TOKEN'), $request->header('X-TIMESTAMP'))) {
                return response(['error' => 'Token has expired'], 409);
            }
            if (!Tokenizer::isValid($request->header('X-TOKEN'), $request->header('X-TIMESTAMP'))) {
                return response(['error' => 'Token is invalid'], 409);
            }
            return $next($request);
        }
        return response(['error' => 'Request does not contain the validation token'], 403);
    }
}
