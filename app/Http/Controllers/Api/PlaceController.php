<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function list(){
        $places = Places::all();
        $list = [];

        foreach($places as $place){
            $object = [
                "id" => $place->id,
                "name" => $place->name,
                "created_at" => $place->created_at,
                "updated_at" => $place->updated_at
            ];
            
            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($id){
            $place = Place::where('id', '=', $id)->first();
                $object = [
                    "id" => $place->id,
                    "name" => $place->name,
                    "created_at" => $place->created_at,
                    "updated_at" => $place->updated_at
                ];
            return response()->json($object);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'place' => 'required'
        ]);

        $place=Place::create([
            'place' => $data['place']
        ]);
        if($place){
            return response()->json([
                'message' => 'Se ha creado un registro',
                'data' => $place
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
            'name' => 'required'
            ]);

            $place = Place::where('id', '=', $data['id'])->first();

            if($place){
                $place->date=$data['name'];
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
