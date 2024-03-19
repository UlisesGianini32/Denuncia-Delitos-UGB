<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function list(){
        $complaints = Complaint::all();
        $list = [];

        foreach($complaints as $complaint){
            $object = [
                "id" => $complaint->id,
                "name" => $complaint->name,
                "categories" => $complaint->categories,
                "suspects" => $complaint->suspects,
                "places" => $complaint->places,
                "created_at" => $complaint->created_at,
                "updated_at" => $complaint->updated_at
            ];
            
            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($id){
            $complaint = Complaint::where('id', '=', $id)->first();
                $object = [
                "id" => $complaint->id,
                "name" => $complaint->name,
                "categories" => $complaint->categories,
                "suspects" => $complaint->suspects,
                "places" => $complaint->places,
                "created_at" => $complaint->created_at,
                "updated_at" => $complaint->updated_at
                ];
            return response()->json($object);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'complaint' => 'required'
        ]);

        $complaint=Complaint::create([
            'complaint' => $data['complaint']
        ]);
        if($complaint){
            return response()->json([
                'message' => 'Se ha creado un registro',
                'data' => $complaint
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
            'categories' => 'required',
            'suspects' => 'required',
            'places' => 'required'
            ]);

            $complaint = Complaint::where('id', '=', $data['id'])->first();

            if($complaint){
                $complaint->date=$data['name'];
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
        public function Elements($id){
            $complaint = Complaint::where('complaint', '=', $complaint)->get();
            
            $complaintArray = [];
            foreach($complaint as $complaint){
                $complaintArray = [
                    "id" => $complaint->id,
                    "name" => $complaint->Name,
                    "categories" => $complaint->Categories,
                    "suspects" => $complaint->Suspects,
                    "places" => $complaint->Places,
                    "created_at" => $complaint->Created_at,
                    "updated_at" => $complaint->Updated_at,
                ];
            }    
            
            return response()->json($object);
        }
    }
