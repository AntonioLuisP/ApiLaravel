<?php

namespace App\Http\Middleware;

use Closure;

class sendDenuncia
{

    public function handle($request, Closure $next)
    {
        if ($request->header('Authorization') == "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiYXBpX2FnbG9tZXJhY2FvX3Nhb19sdWlzIiwiYXBwX25hbWUiOiJhcHBfYWdsb21lcmFjYW8iLCJzdGF0dXMiOiJhcHBfYWdsb21lcmFjYW9fb24ifQ==.1ovjpEp1H3TnYV8EpcjRwPwn34W9AIBKYJkc3oIHlSk=") {
            return $next($request);
        } else{
            $resultado['status_token'] = false;    
            $resultado['ok'] = false;
            $resultado['message'] = 'Token invalido';
            return response()->json($resultado,401);        
        }          
    }
}
