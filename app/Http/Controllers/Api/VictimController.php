<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Victim;
use Illuminate\Http\Request;

class VictimController extends Controller
{
    public function list(Request $request){
        $victims = Victim::all(); // Cambiar $victim a $victims
        $list = [];

        foreach($victims as $victim){ // Cambiar $victims a $victim
            $object = [
                "id" => $victim->id,
                "victim_id" => $victim->victim_id,
                "victim_name" => $victim->victim_name,
                "created_at" => $victim->created_at,
                "updated_at" => $victim->updated_at
            ];
            
            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($id){
            $victim = Victim::where('id', '=', $id)->first();
                $object = [
                    "id" => $victim->id,
                    "victim_id" => $victim->victim_id,
                    "victim_name" => $victim->victim_name,
                    "created_at" => $victim->created_at,
                    "updated_at" => $victim->updated_at
                ];
            return response()->json($object);
    }

    public function update(Request $request){
        $data = $request -> validate([
            'id' => 'required|numeric',
            'victim_id' => 'required|numeric',
            'victim_name' => 'required',
        ]);
   
        $victim = Victim::where('id', '=', $data['id'])->first();

        if($victim) {
            $old = clone $victim;

            $victim -> victim_id = $data['victim_id'];
            $victim -> victim_name = $data['victim_name'];
        
            if($victim->save()){ // Cambiar $user a $victim
                return response() ->json([
                    'message' => 'successfully created victim',
                    'old' => $old,
                    'new' => $victim // Cambiar $user a $victim
                ]);
            }else{
                return response() ->json([
                    'message' => 'Error creating a victim',
                ]);
            }
        }else{
            return response() ->json([
                'message' => 'Item not found',
            ]);
        }
    }


    public function create(Request $request){
        $data = $request -> validate([
            'victim_id' => 'required|numeric',
            'victim_name' => 'required',
        ]);

        $victim = Victim::create([
            'victim_id' => $data['victim_id'],
            'victim_name' => $data['victim_name'],
        ]);

        if($victim) {
            return response() ->json([
                'message' => 'successfully created victim',
                'data' => $victim
            ]);

        }else{
            return response() ->json([
                'message' => 'Error creating a victim',
            ]);
        }
    }

    public function Elements($id){
        $victim = Victim::where('victim_name', '=', $id)->get(); // Cambiar $victim a $id
        
        $victimArray = [];
        foreach($victim as $item){ // Cambiar $victims a $victim
            $victimArray = [ // Cambiar $victimArray a $object
                "id" => $item->id, // Cambiar $victim a $item
                "victim_id" => $item->victim_id, // Cambiar $victim a $item
                "victim_name" => $item->victim_name, // Cambiar $victim a $item
                "created_at" => $item->created_at, // Cambiar $victim a $item
                "updated_at" => $item->updated_at, // Cambiar $victim a $item
            ];
        }    
        
        return response()->json($victimArray); // Cambiar $object a $victimArray
    }

    public function ListUser($id){
        $victims = Victim::where('id', $id)->get(); // Cambiar $victims a $victim
        $victimArray = [];
        foreach ($victims as $victim) {
            $victimArray[] = [
                "id" => $victim->id,
                "victim_id" => $victim->victim_id,
                "victim_name" => $victim->victim_name,
            ];
        }    
        return response()->json($victimArray);
    }
}
