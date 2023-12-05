<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;
use App\Models\Viagens;
use App\Models\Rotas;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ViagensController extends Controller
{
    public function store(Request $request){
        $dados = $request->all();

        if(! file_exists($request->file('referencia'))){
            return response()->json("falha ao comprar bilhete, insira o seu comprovativo");
        }

        $comprovativo = $request->file("referencia");
        $caminho = $comprovativo->store("public/comprovativo");
        $dados['referencia'] = Storage::url($caminho);


        try{
            $dados_pagamento = [
                "Desconto" =>  $dados['desconto'],
                "Total" => $dados['total'],
                "referencia" => $dados['referencia'],
            ];

            DB::beginTransaction();

           /* $assento = $this->verificar_assento($request);
            if($assento){
                return response()->json('falha ao selecionar acento');
            }*/

            $rotaSelecionada = Rotas::find($request->rota_id);
            if ($rotaSelecionada->estado == "esgotado") {
                return response()->json("rota indisponivel, selecione outro horario");
            }

            $pagamento = Pagamento::create($dados_pagamento);
            
            $dados['pagamento_id'] = $pagamento->id;
            $dados['user_id'] = 1;
            
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

    public function verificar_assento($request){
        $result = DB::select("SELECT * FROM venda where dataViagem = {$request->dataViagem} and horaViagem  = {$request->horaViagem} and n_assento= {$request->n_assento} and rota_id = {$request->rota_id}");
        
        return $result;
        
    }
}



