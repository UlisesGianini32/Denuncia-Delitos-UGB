<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function list(){
        $users = Users::all();
        $list = [];

        foreach($users as $user){
            $object = [
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "email_verified_at" => $user->email_verified_at,
                "password" => $user->password,
                "remember_token" => $user->remember_token,
                "created_at" => $user->created_at,
                "update_at"=> $user->update_at
            ];
            
            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($id){
            $user = User::where('id', '=', $id)->first();
                $object = [
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $user->email,
                    "email_verified_at" => $user->email_verified_at,
                    "password" => $user->password,
                    "remember_token" => $user->remember_token,
                    "created_at" => $user->created_at,
                    "update_at"=> $user->update_at
                ];
            return response()->json($object);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'user' => 'required'
        ]);

        $user=User::create([
            'user' => $data['user']
        ]);
        if($user){
            return response()->json([
                'message' => 'Se ha creado un registro',
                'data' => $user
            ]);
        }else{
            return response()->json([
                'message' => 'Error al crear el registro',
            ]);
        }}
        
        public function update(Request $request){
            
            $data = $request->validate([
                'id' => 'required|integer|min1',
                'name' => 'required',
                'email' => 'required',
                'email_verified_at' => 'required',
                'password' => 'required',
                'remember_token' => 'required'
                ]);
    
                $user = User::where('id', '=', $data['id'])->first();
    
                if($user){
                    $user->date=$data['name'];
                    if($user->save()){
                        $object =
                        [
                            "response" => 'susces, Item update correctly',
                            "old" => $old,
                            "new" => $date,
                        ];
                        return response()->json($object);
                    }else{
                        $object =
                        [
                            "response" =>'Error: stupid',
                        ];
                        return response()->json($object);
                    }
                }else{
                    $object = 
                    [
                        "response" => 'Error: stupid'
                    ];
                    return response()->json($object);
        }
    }
} 
