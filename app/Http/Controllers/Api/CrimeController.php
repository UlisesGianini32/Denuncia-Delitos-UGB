<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Crime;
use Illuminate\Http\Request;

class CrimeController extends Controller
{
    public function list(Request $request){
        $crimes = Crime::all();
        $list = [];

        foreach($crimes as $crime){
            $object = [
                "id" => $crime->id,
                "id_complaint" => $crime->id_complaint,
                "crime_name" => $crime->crime_name,
                "crime_description" => $crime->crime_description,
                "created_at" => $crime->created_at,
                "updated_at" => $crime->updated_at
            ];
            
            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($id){
            $crime = Crime::where('id', '=', $id)->first();
                $object = [
                "id" => $crime->id,
                "id_complaint" => $crime->id_complaint,
                "crime_name" => $crime->crime_name,
                "crime_description" => $crime->crime_description,
                "created_at" => $crime->created_at,
                "updated_at" => $crime->updated_at
                ];
            return response()->json($object);
    }

    public function update(Request $request){
        $data = $request -> validate([
            'id' => 'required|numeric',
            'id_complaint' => 'required|numeric',
            'crime_name' => 'required',
            'crime_description' => 'required',
        ]);
   
        $crime = Crime::where('id', '=', $data['id'])->first();

        if($crime) {
            $old = clone $crime;

            $crime -> id_complaint = $data['id_complaint'];
            $crime -> crime_name = $data['crime_name'];
            $crime -> crime_description = $data['crime_description'];
        
            if($user->save()){
                return response() ->json([
                    'message' => 'successfully created crime',
                    'old' => $old,
                    'new' => $user
                ]);
            }else{
                return response() ->json([
                    'message' => 'Error creating a crime',
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
            'id_complaint' => 'required|numeric',
            'crime_name' => 'required',
            'crime_description' => 'required',
        ]);

        $crime = Crime::create([
            'id_complaint' => $data['id_complaint'],
            'crime_name' => $data['crime_name'],
            'crime_description' => $data['crime_description'],
        ]);

        if($crime) {
            return response() ->json([
                'message' => 'successfully created crime',
                'data' => $crime
            ]);

        }else{
            return response() ->json([
                'message' => 'Error creating a crime',
            ]);
        }
    }
        public function Elements($id){
            $crime = Crime::where('crime', '=', $crime)->get();
            
            $crimeArray = [];
            foreach($crime as $crime){
                $crimeArray = [
                    "id" => $crime->id,
                    "id_complaint" => $crime->id_complaint,
                    "crime_name" => $crime->crime_name,
                    "crime_description" => $crime->crime_description,
                    "created_at" => $crime->Created_at,
                    "updated_at" => $crime->Updated_at,
                ];
            }    
            
            return response()->json($object);
        }

        public function ListUser($id){
            $crime = Crime::where('id', $id)->get();
            $crimeArray = [];
            foreach ($crimes as $crime) {
                $crimeArray[] = [
                    "id" => $crime->id,
                    "id_complaint" => $crime->id_complaint,
                    "crime_name" => $crime->crime_name,
                    "crime_description" => $crime->crime_description,
                ];
            }    
            return response()->json($crimeArray);
        }
    }

