<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('apiJwt', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['ok'=> false,'message' => 'Credencias Incorretas'], 401);
        }
        $resultado['ok'] = true;
        $resultado['access_token'] = $token;
        $resultado['expires_in'] = auth('api')->factory()->getTTL() * 60;
        $resultado['token_type'] = 'bearer';
        $resultado['message'] = 'Logado com sucesso';
        return response()->json($resultado);        
    }

    // public function me()
    // {
    //     $resultado['ok'] = true;
    //     $resultado['status_token'] = true;    
    //     $resultado['user']=auth('api')->user();
    //     return response()->json($resultado);        
    // }

    public function logout()
    {
        auth('api')->logout();
        $resultado['ok'] = true;    
        $resultado['status_token'] = true;    
        $resultado['message'] = 'Saiu com sucesso';
        return response()->json($resultado);        
    }

    // public function refresh()
    // {
    //     $resultado['ok'] = true;
    //     $resultado['status_token'] = true;  
    //     $resultado['token_type'] = 'bearer';  
    //     $resultado['access_token'] = auth('api')->refresh();
    //     $resultado['expires_in'] = auth('api')->factory()->getTTL() * 60;      
    //     $resultado['message'] = 'Usuario Atualizado';
    //     return response()->json($resultado);        
    // }
    
}