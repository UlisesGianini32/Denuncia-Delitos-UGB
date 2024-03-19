<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Info_Sus;

class Info_SusController extends Controller
{
    public function list(){
        $info_sus = Info_Sus::all();
        $list = [];

        foreach($info_suss as $info_sus){
            $object = [
                    "id" => $info_sus->id,
                    "name" => $info_sus->name,
                    "age" => $info_sus->age,
                    "ocupation" => $info_sus->ocupation,
                    "description" => $info_sus->description,
                    "background" => $info_sus->background,
                    "addres" => $info_sus->addres,
                    "created_at" => $info_sus->created_at,
                    "updated_at" => $info_sus->updated_at
            ];
            
            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($id){
            $info_sus = Info_Sus::where('id', '=', $id)->first();
                $object = [
                    "id" => $info_sus->id,
                    "name" => $info_sus->name,
                    "age" => $info_sus->age,
                    "ocupation" => $info_sus->ocupation,
                    "description" => $info_sus->description,
                    "background" => $info_sus->background,
                    "addres" => $info_sus->addres,
                    "created_at" => $info_sus->created_at,
                    "updated_at" => $info_sus->updated_at
                ];
            return response()->json($object);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'info_sus' => 'required'
        ]);

        $info_sus=Info_Sus::create([
            'info_sus' => $data['info_sus']
        ]);
        if($info_sus){
            return response()->json([
                'message' => 'Se ha creado un registro',
                'data' => $info_sus
            ]);
        }else{
            return response()->json([
                'message' => 'Error al crear el registro',
            ]);
        }
    }
    
    public function update(Request $request){
        
        $data = $request->validate([
            'id' => 'required|integer|min1',
            'name' => 'required',
            'age' => 'required',
            'ocupation' => 'required',
            'description' => 'required',
            'background' => 'required',
            'addres' => 'required'
            ]);

            $info_sus = Info_Sus::where('id', '=', $data['id'])->first();

            if($info_sus){
                $info_sus->date=$data['name'];
                if($date->save()){
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
