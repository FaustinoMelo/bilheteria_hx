<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;
use App\Models\Viagens;
use App\Models\Rotas;
use Illuminate\Support\Facades\DB;


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

            $rotaSelecionada = Rotas::find($request->rota_id);
            if ($rotaSelecionada->estado == "esgotado") {
                return response()->json("rota indisponivel, selecione outro horario");
            }

            $pagamento = Pagamento::create($dados_pagamento);
            
            $dados['pagamento_id'] = $pagamento->id;
            $dados['user_id'] = 1;;
            
            $id = $dados['rota_id'];
            
           // $dados['total'] -= $rota->desconto;
            $ocupantes = $this->updateOcupantesQtd($id);

            

            $viagem = Viagens::create($dados);
            DB::commit();

            return response()->json($viagem);

        }catch(Exception $e){
            DB::rollback();
            return response()->json($e);
        }

    }

    public function updateOcupantesQtd(int $id){

        $rota = Rotas::find($id);

        if($rota->total_ocupantes >= 1){

            $qtd_ocupantes = $rota->total_ocupantes - 1;
            
            $rota->update([
                'total_ocupantes' => $qtd_ocupantes
            ]);

            if($qtd_ocupantes <= 0){
                $rota->estado = 'esgotado';
                $rota->save();
            }

            return $qtd_ocupantes;
        }else{
            return response()->json("não é possivel reduzir esta quantidade");
        }  

    }

    public function showAll(){
        try{
            $users = Viagens::get();
            return response()->json($users);
        }catch(Exception $e){
            return response()->json($e);
        } 
    }
}



