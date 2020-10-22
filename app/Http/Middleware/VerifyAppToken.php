<?php

namespace App\Http\Middleware;

use App\Services\Tokenizer;
use Closure;
use Illuminate\Http\Request;

class VerifyAppToken
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('X-TIMESTAMP') && $request->hasHeader('X-TOKEN')) {
            $token = new Tokenizer($request->header('X-TIMESTAMP'), $request->header('X-TOKEN'));
            if ($token->isExpired()) {
                return response(['error' => 'Token has expired'], 409);
            }
            if (!$token->isValid()) {
                return response(['error' => 'Token is invalid'], 409);
            }
            return $next($request);
        }
        return response(['error' => 'Request does not contain the validation token'], 403);
    }
}
