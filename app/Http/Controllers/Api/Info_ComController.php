<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Info_Com;
use Illuminate\Http\Request;

class Info_ComController extends Controller
{
    public function list(){
        $info_com = Info_Com::all();
        $list = [];

        foreach($info_coms as $info_com){
            $object = [
                "id" => $info_com->id,
                "name" => $info_com->name,
                "age" => $info_com->age,
                "ocupation" => $info_com->ocupation,
                "description" => $info_com->description,
                "cell_phone" => $info_com->cell_phone,
                "created_at" => $info_com->created_at,
                "updated_at" => $info_com->updated_at
            ];
            
            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($id){
            $info_com = Info_Com::where('id', '=', $id)->first();
                $object = [
                    "id" => $info_com->id,
                    "name" => $info_com->name,
                    "age" => $info_com->age,
                    "ocupation" => $info_com->ocupation,
                    "description" => $info_com->description,
                    "cell_phone" => $info_com->cell_phone,
                    "created_at" => $info_com->created_at,
                    "updated_at" => $info_com->updated_at
                ];
            return response()->json($object);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'info_com' => 'required'
        ]);

        $info_com=Info_Com::create([
            'info_com' => $data['info_com']
        ]);
        if($info_com){
            return response()->json([
                'message' => 'Se ha creado un registro',
                'data' => $info_com
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
            'cell_phone' => 'required'
            ]);

            $info_com = Info_Com::where('id', '=', $data['id'])->first();

            if($info_com){
                $info_com->date=$data['name'];
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
