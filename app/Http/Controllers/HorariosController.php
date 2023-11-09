<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horarios;

class HorariosController extends Controller
{
    public function store(Request $request){
        $dados = $request->all();

        $horarios=[
            'hora' => $dados['hora'],
            'user_id' => 2 //auth()->user()->id
        ];

        $resultado = Horarios::create($horarios);
        return response()->json($resultado);
    }
}
