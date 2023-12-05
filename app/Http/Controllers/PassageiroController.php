<?php

namespace App\Http\Controllers;

use App\Models\Passageiros;
use Illuminate\Http\Request;
class PassageiroController extends Controller
{
    public function store(Request $request){
        $dados = $request->all();
        $dados['user_id'] = 1;
        $passageiro = Passageiros::create($dados);
        return response()->json($passageiro);

    }
}
