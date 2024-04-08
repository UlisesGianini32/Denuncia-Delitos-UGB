<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function list(Request $request)
    {
        $complaints = Complaint::all();
        $list = [];

        foreach ($complaints as $complaint) {
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

    public function item($id)
    {
        $complaint = Complaint::where('id', $id)->first();

        if (!$complaint) {
            return response()->json([
                'message' => 'Item not found',
            ], 404);
        }

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

    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|numeric',
            'complaint_id' => 'required|numeric',
            'description' => 'required',
            'complaint_status' => 'required',
            'victim_id' => 'required|numeric',
            'witness_id' => 'required|numeric',
            'suspect_id' => 'required|numeric',
        ]);

        $complaint = Complaint::find($data['id']);

        if (!$complaint) {
            return response()->json([
                'message' => 'Item not found',
            ], 404);
        }

        $complaint->update($data);

        return response()->json([
            'message' => 'Successfully updated complaint',
            'data' => $complaint
        ]);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'complaint_id' => 'required|numeric',
            'description' => 'required',
            'complaint_status' => 'required',
            'victim_id' => 'required|numeric',
            'witness_id' => 'required|numeric',
            'suspect_id' => 'required|numeric',
        ]);

        $complaint = Complaint::create($data);

        return response()->json([
            'message' => 'Successfully created complaint',
            'data' => $complaint
        ], 201);
    }

    public function Elements($id)
    {
        $complaints = Complaint::where('id', $id)->get();

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
                "created_at" => $complaint->created_at,
                "updated_at" => $complaint->updated_at,
            ];
        }

        return response()->json($complaintArray);
    }

    
    public function searchComplaints($searchTerm) {
        $complaints = Complaint::where('description', 'like', '%' . $searchTerm . '%') // Busca por coincidencia en la descripción
            ->latest()
            ->get();
    
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
            $resultArray[] = $complaintDetails; // Agrega los detalles de la queja al array resultante
        }
    
        return response()->json($resultArray); // Devuelve el array completo como JSON
    }    

}
