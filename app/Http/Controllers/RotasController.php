<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rotas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RotasController extends Controller
{
    public function index()
    {
        $rotas = DB::select("SELECT * FROM rotas inner join horarios on rotas.horario_id = horarios.id order by produtos.id desc 
        ");

        return response()->json($rotas);
    }
    public function store(Request $request){
            
        $data = $request->all();

        /*$var = Session::all();*/
        $data['user_id'] = 1; //$var['user_id'];

        try{
            $rota = Rotas::create($data);
            return response()->json($rota);
        }catch(Exception $e){
            return response()->json($e);
        }
    
    }

    public function show($origem, $destino){

        try{

        $itens = DB::select("SELECT * FROM rotas inner join horarios on rotas.horario_id = horarios.id where rotas.origem = '{$origem}' and rotas.destino = '{$destino}'");
            $rotas=[];
            foreach($itens as $iten){
                $rotas = $iten;
            }
    
            return response()->json($rotas);

        }catch(Exception $e){
            return response()->json($e);
        }
    
    }
    
    public function showAll(){
        $resultado = Rotas::get();
        return response()->json($resultado);
    }

}
