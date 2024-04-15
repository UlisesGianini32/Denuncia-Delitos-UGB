<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Suspect;
use Illuminate\Http\Request;

class SuspectController extends Controller
{
    public function list(Request $request){
        $suspects = Suspect::all();
        $list = [];

        foreach($suspects as $suspect){
            $object = [
                "id" => $suspect->id,
                "suspect_id" => $suspect->suspect_id,
                "suspect_name" => $suspect->suspect_name,
                "created_at" => $suspect->created_at,
                "updated_at" => $suspect->updated_at
            ];
            
            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($id){
        $suspect = Suspect::find($id);

        if(!$suspect) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $object = [
            "id" => $suspect->id,
            "suspect_id" => $suspect->suspect_id,
            "suspect_name" => $suspect->suspect_name,
            "created_at" => $suspect->created_at,
            "updated_at" => $suspect->updated_at
        ];
        
        return response()->json($object);
    }

    public function update(Request $request){
        $data = $request->validate([
            'id' => 'required|numeric',
            'suspect_id' => 'required|numeric',
            'suspect_name' => 'required'
        ]);
   
        $suspect = Suspect::find($data['id']);

        if(!$suspect) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $old = clone $suspect;

        $suspect->suspect_id = $data['suspect_id'];
        $suspect->suspect_name = $data['suspect_name'];
    
        if($suspect->save()){
            return response()->json([
                'message' => 'Successfully updated suspect',
                'old' => $old,
                'new' => $suspect
            ]);
        }else{
            return response()->json([
                'message' => 'Error updating suspect',
            ]);
        }
    }

    public function create(Request $request){
        $data = $request->validate([
            'suspect_id' => 'required|numeric',
            'suspect_name' => 'required'
        ]);

        $suspect = Suspect::create([
            'suspect_id' => $data['suspect_id'], 
            'suspect_name' => $data['suspect_name'],
        ]);

        if($suspect) {
            return response()->json([
                'message' => 'Successfully created suspect',
                'data' => $suspect
            ]);
        }else{
            return response()->json([
                'message' => 'Error creating a suspect',
            ]);
        }
    }

    public function elements($id){
        $suspects = Suspect::where('suspect_id', $id)->get();
        
        $suspectArray = [];
        foreach($suspects as $suspect){
            $suspectArray[] = [
                "id" => $suspect->id,
                "suspect_id" => $suspect->suspect_id,
                "suspect_name" => $suspect->suspect_name,
                "created_at" => $suspect->created_at,
                "updated_at" => $suspect->updated_at
            ];
        }    
        
        return response()->json($suspectArray);
    }

    public function listUser($id){
        $suspect = Suspect::where('id', $id)->get();
        $suspectArray = [];
        foreach ($suspect as $sus) {
            $suspectArray[] = [
                "id" => $sus->id,
                "suspect_id" => $sus->suspect_id,
                "suspect_name" => $sus->suspect_name,
            ];
        }    
        return response()->json($suspectArray);
    }
}
