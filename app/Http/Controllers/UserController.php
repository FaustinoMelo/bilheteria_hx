<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    public function store(Request $request)
    {
        $data = $request->all();

        $data_user=[
            'email'=> $data['email'],
            'name'=> $data['name'],
            'password'=> bcrypt($data['password'])
        ];

        $user = User::create($data_user);
        return response()->json($user);
        
    }

    public function showAll(){
        try{
            $users = User::get();
            return response()->json($users);
        }catch(Exception $e){
            return response()->json($e);
        } 
    }

}
