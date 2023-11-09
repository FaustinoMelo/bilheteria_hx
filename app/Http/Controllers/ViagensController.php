<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;
use App\Models\Viagens;

class ViagensController extends Controller
{
    public function store(Request $request){
        $dados = $request->all();

        $dados_pagamento = [
            "Desconto" =>  $dados['desconto'],
            "Total" => $dados['total'],
            "referencia" => $dados['referencia'],
        ];

        $pagamento = Pagamento::create($dados_pagamento);
        
        $dados['pagamento_id'] = $pagamento->id;
        $dados['user_id'] = 1;
        
        $viagem = Viagens::create($dados);
        return response()->json($viagem);

    }
}



