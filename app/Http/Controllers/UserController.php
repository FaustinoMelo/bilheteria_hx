<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Passageiros;
use App\Models\Contactos;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->all();

        try{
                
            $contacto = Contactos::create(['contacto'=>$data['contacto']]);
            //return response()->json($contacto);

            $data_user=[
                'email'=> $data['email'],
                'name'=> $data['name'],
                'password'=> $data['password']
            ];

            $user = User::create($data_user);

            $data['user_id'] = $user->id;
            $data['contacto_id'] = $contacto->id;

            $passageiro = Passageiros::create($data);
            return response()->json($passageiro);
            
        }catch(Exception $e){
            return response()->json($e);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
