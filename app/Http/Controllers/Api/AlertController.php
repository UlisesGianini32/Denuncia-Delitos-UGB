<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function list(){
        $alerts = Alerts::all();
        $list = [];

        foreach($alerts as $alert){
            $object = [
                    "id" => $alert->id,
                    "sectors" => $alert->Sectors,
                    "complaint" => $alert-> Complaint,
                    "level" => $alert->Level,
                    "created_at" => $alert->Created_at,
                    "updated_at" => $alert->Updated_at
            ];
            
            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($id){
            $alert = Alert::where('id', '=', $id)->first();
                $object = [
                    "id" => $alert->id,
                    "sectors" => $alert->Sectors,
                    "complaint" => $alert-> Complaint,
                    "level" => $alert->Level,
                    "created_at" => $alert->Created_at,
                    "updated_at" => $alert->Updated_at
                ];
            return response()->json($object);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'alert' => 'required'
        ]);

        $alert=Alert::create([
            'alert' => $data['alert']
        ]);
        if($alert){
            return response()->json([
                'message' => 'Se ha creado un registro',
                'data' => $alert
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
            'sectors' => 'required',
            'complaint' => 'required',
            'level' => 'required'
            ]);

            $alert = Alert::where('id', '=', $data['id'])->first();

            if($alert){
                $alert->date=$data['name'];
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
