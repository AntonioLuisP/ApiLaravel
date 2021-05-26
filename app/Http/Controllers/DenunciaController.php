<?php

namespace App\Http\Controllers;
use App\Http\Requests\DenunciaRequest;
use App\Models\Denuncia;
use Illuminate\Http\Request;

class DenunciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('sendDen')->only('store');
        $this->middleware('apiJwt')->except('store');
    }
    
    public function index()
    {
        $denuncia = Denuncia::all(); 
        $resultado['status_token'] = true;    
        $resultado['ok'] = true;
        if(count($denuncia) > 0 ){
            $resultado['message'] = "Denuncias encontrada";
        } else{
            $resultado['message'] = "Nenhuma denuncia encontrada";
        }
        $resultado['data'] = $denuncia;
        return response()->json($resultado);        
    }

    public function store(DenunciaRequest $request) {
        $resultado['status_token'] = true;    
        try{
            Denuncia::create($request->all()); 
            $resultado['ok'] = true;
            $resultado['message'] = "Denucia salva com sucesso";
        } catch(\Exception $ex) {
            $resultado['ok'] = false;
            $resultado['message'] = "Nao foi possivel salvar sua denucia";
        } finally {
            return response()->json($resultado,201);        
        }
    }

    public function show($id) {
        $denuncia = Denuncia::find($id); 
        $resultado['status_token'] = true;    
        $resultado['ok'] = true;
        if(!is_null($denuncia)){
            $resultado['message'] = "Denuncia encontrada";
        } else{
            $resultado['message'] = "Denuncia nao encontrada";
        }
        $resultado['data'] = $denuncia;
        return response()->json($resultado);
    }

}