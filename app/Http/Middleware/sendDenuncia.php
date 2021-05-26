<?php

namespace App\Http\Middleware;

use Closure;

class sendDenuncia
{

    public function handle($request, Closure $next)
    {
        // coloque o token
        if ($request->header('Authorization') == "TOKEN") {
            return $next($request);
        } else{
            $resultado['status_token'] = false;    
            $resultado['ok'] = false;
            $resultado['message'] = 'Token invalido';
            return response()->json($resultado,401);        
        }          
    }
}
