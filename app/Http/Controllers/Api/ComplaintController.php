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

    public function update(Request $request){
        $data = $request -> validate([
            'id' => 'required|numeric',
            'name' => 'required',
            'categories' => 'required',
            'suspects' => 'required',
            'places' => 'required',
        ]);
   
        $complaint = Complaint::where('id', '=', $data['id'])->first();

        if($complaint) {
            $old = clone $complaint;

            $complaint -> name = $data['name'];
            $complaint -> categories = $data['categories'];
            $complaint -> suspects = $data['suspects'];
            $complaint -> places = $data['places'];


            if($user->save()){
                return response() ->json([
                    'message' => 'successfully created complaint',
                    'old' => $old,
                    'new' => $user
                ]);
            }else{
                return response() ->json([
                    'message' => 'Error creating a complaint',
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
            'name' => 'required',
            'categories' => 'required',
            'suspects' => 'required',
            'places' => 'required',

        ]);

        $complaint = Complaint::create([
            'name' => $data['name'],
            'categories' => $data['categories'],
            'suspects' => $data['suspects'],
            'places' => $data['places'],
        ]);

        if($complaint) {
            return response() ->json([
                'message' => 'successfully created complaint',
                'data' => $complaint
            ]);

        }else{
            return response() ->json([
                'message' => 'Error creating a complaint',
            ]);
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
        public function SearchComplaints($userId, $searchTerm) {
            $complaints = ModelComplaint::where('user_id', $userId)
                ->whereHas('categories', function ($query) use ($searchTerm) {
                    $query->where('buy', 'like', $searchTerm . '%'); // Busca por coincidencia con los primeros caracteres
                })
                ->latest()
                ->get();
        
            $resultArray = [];
        
            foreach ($complaints as $complaint) {
                $complaintDetails = [
                    "id" => $complaint->id,
                    "name" => $complaint->name,
                    "categories" => $complaint->categories,
                    "places" => $complaint->places,
                    "suspects" => $complaint->suspects,
                ];
                $resultArray[] = $complaintDetails; // Agrega los detalles de la compra al array resultante
            }
        
            return response()->json($resultArray); // Devuelve el array completo como JSON
        } 
}
