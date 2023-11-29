<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    public function store(Request $request)
    {
        
        $data = $request->all();

        try{
            $data_user=[
                'email'=> $data['email'],
                'name'=> $data['name'],
                'password'=> $data['password']
            ];

            $user = User::create($data_user);;
            
            return response()->json($user);
        }catch(Exception $e){
            return response()->json($e);
        }

    }

}
