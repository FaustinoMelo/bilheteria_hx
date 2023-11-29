<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;
use App\Models\Viagens;
use App\Models\Rotas;


class ViagensController extends Controller
{
    public function store(Request $request){
        $dados = $request->all();

        try{
            $dados_pagamento = [
                "Desconto" =>  $dados['desconto'],
                "Total" => $dados['total'],
                "referencia" => $dados['referencia'],
            ];

            DB::beginTransaction();

            $pagamento = Pagamento::create($dados_pagamento);
            
            $dados['pagamento_id'] = $pagamento->id;
            $dados['user_id'] = 1;;
            
            $id = $dados['rotas_id'];
            
            $dados['total'] -= $rota->desconto;
            $ocupantes = $this->updateOcupantesQtd($id);

            if($ocupantes<=0){
                $rota->estado = 'esgotado';
                $rota->save();
            }

            $viagem = Viagens::create($dados);
            return response()->json($viagem);

            DB::commit();

        }catch(Exception $e){
            DB::rollback();
            return response()->json($e);
        }

    }

    public function updateOcupantesQtd(int $id){

        $rota = Rotas::find($id);

        if($rota->total_ocupantes >= 1){

            $qtd_ocupantes = $rota->total_ocupantes - 1;
            
            if($qtd_ocupantes >= 0){
                $rota->update([
                    'total_ocupantes' => $qtd_ocupantes
                ]);
                
                return response()->json($qtd_ocupantes);
            }else{
                return response()->json("quantidade insuficiente");
            }

        }else{
            return response()->json("não é possivel reduzir esta quantidade");
        }  

    }
}



