<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Description;
use Illuminate\Http\Request;

class DescriptionController extends Controller
{
    public function list(Request $request){
        $description = Description::all();
        $list = [];

        foreach($descriptions as $description){
            $object = [
                "id" => $description->id,
                "complaint_id" => $description->complaint_id,
                "description" => $description->description,
                "created_at" => $description->created_at,
                "updated_at" => $description->updated_at
            ];
            
            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($id){
            $description = Description::where('id', '=', $id)->first();
                $object = [
                "id" => $description->id,
                "complaint_id" => $description->complaint_id,
                "description" => $description->description,
                "created_at" => $crime->created_at,
                "updated_at" => $crime->updated_at
                ];
            return response()->json($object);
    }

    public function update(Request $request){
        $data = $request -> validate([
            'id' => 'required|numeric',
            'complaint_id' => 'required|numeric',
            'description' => 'required',
        ]);
   
        $description = Description::where('id', '=', $data['id'])->first();

        if($description) {
            $old = clone $description;

            $description -> complaint_id = $data['complaint_id'];
            $description -> description = $data['description'];
        
            if($user->save()){
                return response() ->json([
                    'message' => 'successfully created description',
                    'old' => $old,
                    'new' => $user
                ]);
            }else{
                return response() ->json([
                    'message' => 'Error creating a description',
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
            'complaint_id' => 'required|numeric',
            'description' => 'required',
        ]);

        $crime = Crime::create([
            'complaint_id' => $data['complaint_id'],
            'description' => $data['description'],
        ]);

        if($crime) {
            return response() ->json([
                'message' => 'successfully created description',
                'data' => $crime
            ]);

        }else{
            return response() ->json([
                'message' => 'Error creating a description',
            ]);
        }
    }
        public function Elements($id){
            $description = Description::where('description', '=', $crime)->get();
            
            $descriptionArray = [];
            foreach($descriptions as $description){
                $descriptionArray = [
                    "id" => $description->id,
                    "complaint_id" => $description->complaint_id,
                    "description" => $description->description,
                    "created_at" => $description->Created_at,
                    "updated_at" => $description->Updated_at,
                ];
            }    
            
            return response()->json($object);
        }

        public function ListUser($id){
            $description = Description::where('id', $id)->get();
            $descriptionArray = [];
            foreach ($descriptions as $description) {
                $descriptionArray[] = [
                    "id" => $description->id,
                    "complaint_id" => $description->complaint_id,
                    "description" => $description->description,
                ];
            }    
            return response()->json($descriptionArray);
        }
    }

