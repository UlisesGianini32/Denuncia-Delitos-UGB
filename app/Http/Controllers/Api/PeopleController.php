<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function list(Request $request){
        $peoples = People::all();
        $list = [];

        foreach($peoples as $people){
            $object = [
                "id" => $people->id,
                "full_name" => $people->full_name,
                "age" => $people->age,
                "address" => $people->address,
                "city" => $people->city,
                "phone" => $people->phone,
                "email" => $people->email,
                "created_at" => $people->created_at,
                "updated_at" => $people->updated_at
            ];
            
            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($id){
            $people = People::where('id', '=', $id)->first();
                $object = [
                    "id" => $people->id,
                    "full_name" => $people->full_name,
                    "age" => $people->age,
                    "address" => $people->address,
                    "city" => $people->city,
                    "phone" => $people->phone,
                    "email" => $people->email,
                    "created_at" => $people->created_at,
                    "updated_at" => $people->updated_at
                ];
            return response()->json($object);
    }

    public function update(Request $request){
        $data = $request -> validate([
            'id' => 'required|numeric',
            'full_name' => 'required',
            'age' => 'required|numeric',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required',
        ]);
   
        $people = People::where('id', '=', $data['id'])->first();

        if($people) {
            $old = clone $people;

            $people -> full_name = $data['full_name'];
            $people -> age = $data['age'];
            $people -> address = $data['address'];
            $people -> city = $data['city'];
            $people -> phone = $data['phone'];
            $people -> email = $data['email'];
        
            if($user->save()){
                return response() ->json([
                    'message' => 'successfully created people',
                    'old' => $old,
                    'new' => $user
                ]);
            }else{
                return response() ->json([
                    'message' => 'Error creating a people',
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
            'full_name' => 'required',
            'age' => 'required|numeric',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required',
        ]);

        $people = People::create([
            'full_name' => $data['full_name'],
            'age' => $data['age'],
            'address' => $data['address'],
            'city' => $data['city'],
            'phone' => $data['phone'],
            'email' => $data['email'],
        ]);

        if($crime) {
            return response() ->json([
                'message' => 'successfully created people',
                'data' => $complaint
            ]);

        }else{
            return response() ->json([
                'message' => 'Error creating a people',
            ]);
        }
    }
        public function Elements($id){
            $people = People::where('people', '=', $people)->get();
            
            $peopleArray = [];
            foreach($people as $people){
                $peopleArray = [
                    "id" => $people->id,
                    "full_name" => $people->full_name,
                    "age" => $people->age,
                    "address" => $people->address,
                    "city" => $people->city,
                    "phone" => $people->phone,
                    "email" => $people->email,
                    "created_at" => $people->created_at,
                    "updated_at" => $people->updated_at
                ];
            }    
            
            return response()->json($object);
        }

        public function ListUser($id){
            $people = People::where('id', $id)->get();
            $peopleArray = [];
            foreach ($peoples as $people) {
                $peopleArray[] = [
                    "id" => $people->id,
                    "full_name" => $people->full_name,
                    "age" => $people->age,
                    "address" => $people->address,
                    "city" => $people->city,
                    "phone" => $people->phone,
                    "email" => $people->email,
                ];
            }    
            return response()->json($peopleArray);
        }
    }

