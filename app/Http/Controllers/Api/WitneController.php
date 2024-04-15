<?php

namespace App\Http\Controllers\Api;

use App\Models\Witne; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WitneController extends Controller
{
    public function list(Request $request){
        $witnes = Witne::all(); 
        $list = [];

        foreach($witnes as $witnes){
            $object = [
                "id" => $witnes->id,
                "witness_id" => $witnes->witness_id,
                "witness_name" => $witnes->witness_name,
                "created_at" => $witnes->created_at,
                "updated_at" => $witnes->updated_at
            ];
            
            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($id)
    {
        $witness = Witness::where('id', '=', $id)->first();
        $object = [
            "id" => $witness->id,
            "witness_id" => $witness->witness_id,
            "witness_name" => $witness->witness_name,
            "created_at" => $witness->created_at,
            "updated_at" => $witness->updated_at
        ];
        return response()->json($object);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|numeric',
            'witness_id' => 'required|numeric',
            'witness_name' => 'required',
        ]);

        $witness = Witness::where('id', '=', $data['id'])->first();

        if ($witness) {
            $old = clone $witness;

            $witness->witness_id = $data['witness_id'];
            $witness->witness_name = $data['witness_name'];

            if ($witness->save()) {
                return response()->json([
                    'message' => 'successfully updated witness',
                    'old' => $old,
                    'new' => $witness
                ]);
            } else {
                return response()->json([
                    'message' => 'Error updating the witness',
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Item not found',
            ]);
        }
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'witness_id' => 'required|numeric',
            'witness_name' => 'required',
        ]);

        $witness = Witness::create([
            'witness_id' => $data['witness_id'],
            'witness_name' => $data['witness_name'],
        ]);

        if ($witness) {
            return response()->json([
                'message' => 'successfully created witness',
                'data' => $witness
            ]);

        } else {
            return response()->json([
                'message' => 'Error creating a witness',
            ]);
        }
    }

    public function Elements($id)
    {
        $witness = Witness::where('crime', '=', $id)->get(); // Cambiar $witnes a $id

        $witnessArray = [];
        foreach ($witness as $witnes) {
            $witnessArray[] = [
                "id" => $witnes->id,
                "witness_id" => $witnes->witness_id,
                "witness_name" => $witnes->witness_name,
                "created_at" => $witnes->created_at,
                "updated_at" => $witnes->updated_at,
            ];
        }

        return response()->json($witnessArray);
    }

    public function ListUser($id)
    {
        $witness = Witness::where('id', $id)->get();
        $witnessArray = [];
        foreach ($witness as $witnes) {
            $witnessArray[] = [
                "id" => $witnes->id,
                "witness_id" => $witnes->witness_id,
                "witness_name" => $witnes->witness_name,
            ];
        }
        return response()->json($witnessArray);
    }
}
