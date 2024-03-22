<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint_status;
use Illuminate\Http\Request;

class Complaint_statusController extends Controller
{
    public function list(Request $request){
        $complaint_satatus = Complaint_Satatus::all();
        $list = [];

        foreach($complaint_satatus as $complaint_satatu){
            $object = [
                "id" => $complaint_satatu->id,
                "id_complaint" => $complaint_satatu->id_complaint,
                "complaint_status" => $complaint_satatu->complaint_status,
                "created_at" => $complaint_satatu->created_at,
                "updated_at" => $complaint_satatu->updated_at
            ];
            
            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($id){
            $complaint_satatu = Complaint_Satatus::where('id', '=', $id)->first();
                $object = [
                    "id" => $complaint_satatu->id,
                    "id_complaint" => $complaint_satatu->id_complaint,
                    "complaint_status" => $complaint_satatu->complaint_status,
                    "created_at" => $complaint_satatu->created_at,
                    "updated_at" => $complaint_satatu->updated_at
                ];
            return response()->json($object);
    }

    public function update(Request $request){
        $data = $request -> validate([
            'id' => 'required|numeric',
            'id_complaint' => 'required|numeric',
            'complaint_status' => 'required',
        ]);
   
        $complaint_satatu = Complaint_Satatus::where('id', '=', $data['id'])->first();

        if($complaint_satatu) {
            $old = clone $complaint_satatu;

            $complaint_satatu -> id_complaint = $data['id_complaint'];
            $complaint_satatu -> complaint_status = $data['complaint_status'];


            if($user->save()){
                return response() ->json([
                    'message' => 'successfully created Complaint_status',
                    'old' => $old,
                    'new' => $user
                ]);
            }else{
                return response() ->json([
                    'message' => 'Error creating a Complaint_status',
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
            'complaint_status' => 'required',
        ]);

        $complaint_satatu = Complaint_Satatus::create([
            'id_complaint' => $data['id_complaint'],
            'complaint_status' => $data['complaint_status'],
        ]);

        if($complaint_satatu) {
            return response() ->json([
                'message' => 'successfully created Complaint_satus',
                'data' => $complaint_satatu
            ]);

        }else{
            return response() ->json([
                'message' => 'Error creating a Complaint_status',
            ]);
        }
    }
        public function Elements($id){
            $complaint_satatus = Complaint_Satatus::where('complaint_status', '=', $complaint_satatu)->get();
            
            $complaint_satatuArray = [];
            foreach($complaint_satatus as $complaint_satatu){
                $complaintArray = [
                    "id" => $complaint_satatu->id,
                    "id_complaint" => $complaint_satatu->id_complaint,
                    "complaint_status" => $complaint_satatu->complaint_status,
                    "created_at" => $complaint_satatu->created_at,
                    "updated_at" => $complaint_satatu->updated_at,
                ];
            }    
            
            return response()->json($object);
        }

        public function SearchcComplaints($id, $searchTerm) {
        $searchTerm = $request->query('search');
        $query = Complaint_Satatus::query();

        if ($searchTerm) {
            $query->where('id_complaint', 'like', '%' . $searchTerm . '%')
                  ->orWhere('complaint_status', 'like', '%' . $searchTerm . '%');
        }
            $resultArray = [];
        
            foreach ($complaint_satatus as $complaint_satatu) {
                $complaint_satatuDetails = [
                    "id" => $complaint_satatu->id,
                    "id_complaint" => $complaint_satatu->id_complaint,
                    "complaint_status" => $complaint_satatu->complaint_status,
                ];
                $resultArray[] = $complaintDetails; // Agrega los detalles de la compra al array resultante
            }
        
            return response()->json($resultArray); // Devuelve el array completo como JSON
        }
        public function ListUser($id){
            $complaint_satatu = Complaint_Satatus::where('id', $id)->get();
            $complaint_satatuArray = [];
            foreach ($complaint_satatus as $complaint_satatu) {
                $complaint_satatuArray[] = [
                    "id" => $complaint_satatu->id,
                    "id_complaint" => $cocomplaint_satatuplaint->id_complaint,
                    "complaint_status" => $complaint_satatu->complaint_status,
                ];
            }    
        
            return response()->json($complaintArray);
        }
}
