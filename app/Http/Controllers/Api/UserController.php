<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reaction;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function list(){
        $users = User::all();
        $list = [];
        foreach($users as $user)
        {
            $object =[
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "created" => $user->created_at,
                "updated" => $user->updated_at
            ];
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id)
    {
        $user = User::where('id', '=', $id) ->first();
        {
            $object =[
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "created" => $user->created_at,
                "updated" => $user->updated_at
            ];
        }
        return response()->json($object);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email'=> 'required',
            'password'=> 'required',
        ]);

        $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        if($user){
            return response()->json([
                'message' => 'A user has been created',
                'data' => $user
            ]);
        }else{
            return response()->json([
                'message' => 'Error creating user',
            ]);
        }
    } 
    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer',
            'name' => 'required',
            'email'=> 'required|email',
        ]);
        
        $user = User::find($data['id']);
        
        if(!$user) {
            return response()->json(["response" =>'Error: User not found']);
        }
    
        $user->name = $data['name'];
        $user->email = $data['email'];
    
        // Verificar si se proporciona una nueva contraseña
        if($request->has('password')) {
            // Hash de la nueva contraseña
            $user->password = Hash::make($request->input('password'));
        }
    
        if($user->save()){
            $object = [
                "response" => 'success, Item updated correctly',
                "user" => $user,
            ];
            return response()->json($object);
        } else {
            return response()->json(["response" =>'Error: Unable to update user']);
        }
    }
    

    public function updatepass(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer',
            'password'=> 'required',
        ]);
        $user = User::where('id', '=', $data['id'])->first();
        
        if($user)
        {
            $old = clone $user;

            $user->password =$data['password'];

            if($user->save()){
                $object =
                [
                    "response" => 'success, Item update correctly',
                    "old" => $old,
                    "new" => $user,
                ];
                return response()->json($object);
            } else{
                $object =
                [
                    "response" =>'Error: stupid',
                ];
                return response()->json($object);
            }
        }else
        {
            $object =
            [
                "response" =>'Error: stupid',
            ];
            return response()->json($object);
        }
    } 
}
