<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;

class apiProtectedRoute extends BaseMiddleware
{

    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $resultado['ok'] = false;
            $resultado['status_token'] = false;    
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                $resultado['message'] = 'Token invalido';
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                $resultado['message'] = 'Token expirado';
            } else {
                $resultado['message'] = 'Token nao inserido';
            }
            return response()->json($resultado,401);        
        }
        return $next($request);
    }
}
