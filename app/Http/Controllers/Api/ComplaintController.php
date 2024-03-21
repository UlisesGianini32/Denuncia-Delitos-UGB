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
                "id_complaint" => $complaint->id_complaint,
                "description" => $complaint->description,
                "complaint_status" => $complaint->complaint_status,
                "id_victim" => $complaint->id_victim,
                "id_witness" => $complaint->id_witness,
                "id_suspect" => $complaint->id_suspect,
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
                    "id_complaint" => $complaint->id_complaint,
                    "description" => $complaint->description,
                    "complaint_status" => $complaint->complaint_status,
                    "id_victim" => $complaint->id_victim,
                    "id_witness" => $complaint->id_witness,
                    "id_suspect" => $complaint->id_suspect,
                    "created_at" => $complaint->created_at,
                    "updated_at" => $complaint->updated_at
                ];
            return response()->json($object);
    }

    public function update(Request $request){
        $data = $request -> validate([
            'id' => 'required|numeric',
            'id_complaint' => 'required|numeric',
            'description' => 'required',
            'complaint_status' => 'required',
            'id_victim' => 'required|numeric',
            'id_witness' => 'required|numeric',
            'id_suspect' => 'required|numeric',
        ]);
   
        $complaint = Complaint::where('id', '=', $data['id'])->first();

        if($complaint) {
            $old = clone $complaint;

            $complaint -> id_complaint = $data['id_complaint'];
            $complaint -> description = $data['description'];
            $complaint -> complaint_status = $data['complaint_status'];
            $complaint -> id_victim = $data['id_victim'];
            $complaint -> id_witness = $data['id_witness'];
            $complaint -> id_suspect = $data['id_suspect'];


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
            'id_complaint' => 'required|numeric',
            'description' => 'required',
            'complaint_status' => 'complaint_status',
            'id_victim' => 'required|numeric',
            'id_witness' => 'required|numeric',
            'id_suspect' => 'required|numeric',

        ]);

        $complaint = Complaint::create([
            'id_complaint' => $data['id_complaint'],
            'description' => $data['description'],
            'complaint_status' => $data['complaint_status'],
            'id_victim' => $data['id_victim'],
            'id_witness' => $data['id_witness'],
            'id_suspect' => $data['id_suspect'],
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
                    "id_complaint" => $complaint->id_complaint,
                    "description" => $complaint->description,
                    "complaint_status" => $complaint->complaint_status,
                    "id_victim" => $complaint->id_victim,
                    "id_witness" => $complaint->id_witness,
                    "id_suspect" => $complaint->id_suspect,
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
            $query->where('id_complaint', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('complaint_status', 'like', '%' . $searchTerm . '%')
                  ->orWhere('id_victim', 'like', '%' . $searchTerm . '%')
                  ->orWhere('id_witness', 'like', '%' . $searchTerm . '%')
                  ->orWhere('id_suspect', 'like', '%' . $searchTerm . '%');
        }
            $resultArray = [];
        
            foreach ($complaints as $complaint) {
                $complaintDetails = [
                    "id" => $complaint->id,
                    "id_complaint" => $complaint->id_complaint,
                    "description" => $complaint->description,
                    "complaint_status" => $complaint->complaint_status,
                    "id_victim" => $complaint->id_victim,
                    "id_witness" => $complaint->id_witness,
                    "id_suspect" => $complaint->id_suspect,
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
                    "id_complaint" => $complaint->id_complaint,
                    "description" => $complaint->description,
                    "complaint_status" => $complaint->complaint_status,
                    "id_victim" => $complaint->id_victim,
                    "id_witness" => $complaint->id_witness,
                    "id_suspect" => $complaint->id_suspect,
                ];
            }    
        
            return response()->json($complaintArray);
        }
}
