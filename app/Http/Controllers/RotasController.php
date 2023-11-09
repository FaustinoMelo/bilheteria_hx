<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rotas;

class RotasController extends Controller
{
    public function store(Request $request){
            
        $data = $request->all();

        try{
            $rota = Rotas::create($data);
            return response()->json($rota);
        }catch(Exception $e){
            return response()->json($e);
        }
    
    }

}
