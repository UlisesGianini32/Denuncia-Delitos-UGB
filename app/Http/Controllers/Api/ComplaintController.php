<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function list(Request $request){
        $complaints = Complaint::all();
        $list = [];

        foreach($complaints as $complaint){
            $object = [
                "id" => $complaint->id,
                "complaint_id" => $complaint->complaint_id,
                "description" => $complaint->description,
                "complaint_status" => $complaint->complaint_status,
                "victim_id" => $complaint->victim_id,
                "witness_id" => $complaint->witness_id,
                "suspect_id" => $complaint->suspect_id,
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
                    "complaint_id" => $complaint->complaint_id,
                    "description" => $complaint->description,
                    "complaint_status" => $complaint->complaint_status,
                    "victim_id" => $complaint->victim_id,
                    "witness_id" => $complaint->witness_id,
                    "suspect_id" => $complaint->suspect_id,
                    "created_at" => $complaint->created_at,
                    "updated_at" => $complaint->updated_at
                ];
            return response()->json($object);
    }

    public function update(Request $request){
        $data = $request -> validate([
            'id' => 'required|numeric',
            'complaint_id' => 'required|numeric',
            'description' => 'required',
            'complaint_status' => 'required',
            'victim_id' => 'required|numeric',
            'witness_id' => 'required|numeric',
            'suspect_id' => 'required|numeric',
        ]);
   
        $complaint = Complaint::where('id', '=', $data['id'])->first();

        if($complaint) {
            $old = clone $complaint;

            $complaint -> complaint_id = $data['complaint_id'];
            $complaint -> description = $data['description'];
            $complaint -> complaint_status = $data['complaint_status'];
            $complaint -> victim_id = $data['victim_id'];
            $complaint -> witness_id = $data['witness_id'];
            $complaint -> suspect_id = $data['suspect_id'];


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
            'complaint_id' => 'required|numeric',
            'description' => 'required',
            'complaint_status' => 'required',
            'victim_id' => 'required|numeric',
            'witness_id' => 'required|numeric',
            'suspect_id' => 'required|numeric',

        ]);

        $complaint = Complaint::create([
            'complaint_id' => $data['complaint_id'],
            'description' => $data['description'],
            'complaint_status' => $data['complaint_status'],
            'victim_id' => $data['id_victim'],
            'witness_id' => $data['witness_id'],
            'suspect_id' => $data['suspect_id'],
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
                    "complaint_id" => $complaint->complaint_id,
                    "description" => $complaint->description,
                    "complaint_status" => $complaint->complaint_status,
                    "victim_id" => $complaint->victim_id,
                    "witness_id" => $complaint->witness_id,
                    "suspect_id" => $complaint->suspect_id,
                    "created_at" => $complaint->Created_at,
                    "updated_at" => $complaint->Updated_at,
                ];
            }    
            
            return response()->json($object);
        }

        public function SearchcComplaints($id, $searchTerm) {
        $searchTerm = $request->query('search');
        $query = Complaint::query();

        if ($searchTerm) {
            $query->where('complaint_id', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('complaint_status', 'like', '%' . $searchTerm . '%')
                  ->orWhere('victim_id', 'like', '%' . $searchTerm . '%')
                  ->orWhere('witness_id', 'like', '%' . $searchTerm . '%')
                  ->orWhere('suspect_id', 'like', '%' . $searchTerm . '%');
        }
            $resultArray = [];
        
            foreach ($complaints as $complaint) {
                $complaintDetails = [
                    "id" => $complaint->id,
                    "complaint_id" => $complaint->complaint_id,
                    "description" => $complaint->description,
                    "complaint_status" => $complaint->complaint_status,
                    "victim_id" => $complaint->victim_id,
                    "witness_id" => $complaint->witness_id,
                    "suspect_id" => $complaint->suspect_id,
                ];
                $resultArray[] = $complaintDetails; // Agrega los detalles de la compra al array resultante
            }
        
            return response()->json($resultArray); // Devuelve el array completo como JSON
        }
        public function ListUser($id){
            $complaint = complaint::where('id', $id)->get();
            $complaintArray = [];
            foreach ($complaints as $complaint) {
                $complaintArray[] = [
                    "id" => $complaint->id,
                    "complaint_id" => $complaint->complaint_id,
                    "description" => $complaint->description,
                    "complaint_status" => $complaint->complaint_status,
                    "victim_id" => $complaint->victim_id,
                    "witness_id" => $complaint->witness_id,
                    "suspect_id" => $complaint->suspect_id,
                ];
            }    
        
            return response()->json($complaintArray);
        }
}
