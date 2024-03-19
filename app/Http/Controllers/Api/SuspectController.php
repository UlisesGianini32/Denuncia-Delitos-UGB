<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Suspect as ModelsSuspect;
use Illuminate\Http\Request;


class SuspectController extends Controller
{
    public function list(){
        $suspects = Suspect::all();
        $list = [];

        foreach($suspects as $suspect){
            $object = [
                "id" => $suspect->id,
                "name" => $suspect->name,
                "age" => $suspect->age,
                "ocupation" => $suspect->ocupation,
                "description" => $suspect->description,
                "created_at" => $suspect->created_at,
                "update_at"=> $suspect->update_at
            ];
            
            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($id){
            $suspect = Suspect::where('id', '=', $id)->first();
                $object = [
                    "id" => $suspect->id,
                    "name" => $suspect->name,
                    "ocupation" => $suspect->ocupation,
                    "description" => $suspect->description,
                    "created_at" => $suspect->created_at,
                    "update_at"=> $suspect->update_at
                ];
            return response()->json($object);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'suspect' => 'required'
        ]);

        $suspect=Suspect::create([
            'suspect' => $data['suspect']
        ]);
        if($suspect){
            return response()->json([
                'message' => 'Se ha creado un registro',
                'data' => $suspect
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
                'Age' => 'required',
                'Ocupation' => 'required',
                'Description' => 'required',
                ]);
    
                $suspect = Suspect::where('id', '=', $data['id'])->first();
    
                if($suspect){
                    $suspect->date=$data['name'];
                    if($suspect->save()){
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
 