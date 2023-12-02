<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocalEmbarque;

class LocalEmbarqueController extends Controller
{
    public function store(Request $request){
        $dados = $request->all();

        $embarque=[
            'nomeLocal' => $dados['nomeLocal'],
            'estado' => $dados['estado'],
            'user_id' => 2 //auth()->user()->id
        ];

        $resultado = LocalEmbarque::create($embarque);
        return response()->json($resultado);
    }

    public function showAll(){
        $resultado = LocalEmbarque::get();
        return response()->json($resultado);
    }

    public function distroy($id)
    {
        $user = LocalEmbarque::find($id);
        $user->delete();
    }
}
