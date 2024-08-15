<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function list(Request $request)
    {
        $employees = Employee::all();
        $list = [];

        foreach ($employees as $employee) {
            $object = [
                "employee_id" => $employee->employee_id,
                "nombre" => $employee->nombre,
                "rpe" => $employee->rpe,
                "created_at" => $employee->created_at,
                "updated_at" => $employee->updated_at
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($employee_id)
    {
        $employee = Employee::where('employee_id', $employee_id)->first();

        if (!$employee) {
            return response()->json([
                'message' => 'Item not found',
            ], 404);
        }

        $object = [
            "employee_id" => $employee->employee_id,
            "nombre" => $employee->nombre,
            "rpe" => $employee->rpe,
            "created_at" => $employee->created_at,
            "updated_at" => $employee->updated_at
        ];

        return response()->json($object);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|numeric',
            'nombre' => 'required',
            'rpe' => 'required',
        ]);

        $employee = Employee::find($data['employee_id']);

        if (!$employee) {
            return response()->json([
                'message' => 'Item not found',
            ], 404);
        }

        if($employee->update($data)){
            return response()->json([
                'message' => 'Successfully updated employee',
                'data' => $employee
            ]);
        } else {
            return response()->json([
                'message' => 'Error unable to save employee',
                'data' => 'try again later'
            ]);
        }
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'rpe' => 'required',
        ]);

        $employee = Employee::create($data);

        return response()->json([
            'message' => 'Successfully created employee',
            'data' => $employee
        ], 201);
    }

    public function Elements($employee_id)
    {
        $employees = Employee::where('employee_id', $employee_id)->get();

        $employeeArray = [];

        foreach ($employees as $employee) {
            $employeeArray[] = [
                "employee_id" => $employee->employee_id,
                "nombre" => $employee->nombre,
                "rpe" => $employee->rpe,
                "created_at" => $employee->created_at,
                "updated_at" => $employee->updated_at,
            ];
        }

        return response()->json($employeeArray);
    }

    public function searchEmployees($searchTerm) {
        $employees = Employee::where('nombre', 'like', '%' . $searchTerm . '%') // Busca por coincidencia en nombre
            ->latest()
            ->get();

        $resultArray = [];

        foreach ($employees as $employee) {
            $employeeDetails = [
                "employee_id" => $employee->employee_id,
                "nombre" => $employee->nombre,
                "rpe" => $employee->rpe,
            ];
            $resultArray[] = $employeeDetails; // Agrega los detalles del empleado al array resultante
        }

        return response()->json($resultArray); // Devuelve el array completo como JSON
    }

    public function delete($employee_id) {
        $employee = Employee::find($employee_id);

        if (!$employee) {
            return response()->json([
                'message' => 'Error: Element not found.'
            ], 404);
        }

        if ($employee->delete()) {
            return response()->json([
                'message' => 'Post deleted successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Error: Something went wrong while deleting the post.'
            ], 500);
        }
    }

    public function getNombre($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        $nombre = $employee->nombre;

        return response()->json($nombre);
    }

    public function getRpe($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        $rpe = $employee->rpe;

        return response()->json($rpe);
    }
}
