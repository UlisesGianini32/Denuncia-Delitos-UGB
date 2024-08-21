<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function list(Request $request)
    {
        $entries = Entry::all();
        $list = [];

        foreach ($entries as $entry) {
            $object = [
                "entry_id" => $entry->entry_id,
                "rpe" => $entry->rep,
                "producto" => $entry->producto,
                "cantidad" => $entry->cantidad,
                "foto" => $entry->foto,
                "firma" => $entry->firma,
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($entry_id)
    {
        $entry = Entry::where('entry_id', $entry_id)->first();

        if (!$entry) {
            return response()->json([
                'message' => 'Item not found',
            ], 404);
        }

        $object = [
            "entry_id" => $entry->entry_id,
            "rpe" => $entry->rep,
            "producto" => $entry->producto,
            "cantidad" => $entry->cantidad,
            "foto" => $entry->foto,
            "firma" => $entry->firma,
        ];

        return response()->json($object);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'entry_id' => 'required|numeric',
            'rpe' => 'required',
            'producto' => 'required',
            'cantidad' => 'required|numeric',
            'foto' => 'nullable',
            'firma' => 'nullable',
        ]);

        $entry = Entry::find($data['entry_id']);

        if (!$entry) {
            return response()->json([
                'message' => 'Item not found',
            ], 404);
        }

        if ($entry->update($data)) {
            return response()->json([
                'message' => 'Successfully updated entry',
                'data' => $entry
            ]);
        } else {
            return response()->json([
                'message' => 'Error unable to save entry',
                'data' => 'try again later'
            ]);
        }
    }

    public function create(Request $request)
{
    $data = $request->validate([
        'rpe' => 'required|alpha_num',
        'producto' => 'required',
        'cantidad' => 'required|numeric',
        'foto' => 'required',
        'firma' => 'required',
    ]);

    try {
        // Intentar crear la entrada
        $entry = Entry::create($data);

        return response()->json([
            'message' => 'Successfully created entry',
            'data' => $entry
        ], 201);
    } catch (\Exception $e) {
        // En caso de fallo, devolver una respuesta de error
        return response()->json([
            'message' => 'Failed to create entry',
            'error' => $e->getMessage()
        ], 500);
    }
}


    public function elements($entry_id)
    {
        $entries = Entry::where('entry_id', $entry_id)->get();

        $entryArray = [];

        foreach ($entries as $entry) {
            $entryArray[] = [
                "entry_id" => $entry->entry_id,
                "rpe" => $entry->rep,
                "producto" => $entry->producto,
                "cantidad" => $entry->cantidad,
                "foto" => $entry->foto,
                "firma" => $entry->firma,
            ];
        }

        return response()->json($entryArray);
    }

    public function searchEntries($searchTerm) {
        $entries = Entry::where('producto', 'like', '%' . $searchTerm . '%') // Busca por coincidencia en producto
            ->latest()
            ->get();

        $resultArray = [];

        foreach ($entries as $entry) {
            $entryDetails = [
                "entry_id" => $entry->entry_id,
                "rpe" => $entry->rep,
                "producto" => $entry->producto,
                "cantidad" => $entry->cantidad,
            ];
            $resultArray[] = $entryDetails;
        }

        return response()->json($resultArray);
    }

    public function delete($entry_id) {
        $entry = Entry::find($entry_id);

        if (!$entry) {
            return response()->json([
                'message' => 'Error: Element not found.'
            ], 404);
        }

        if ($entry->delete()) {
            return response()->json([
                'message' => 'Entry deleted successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Error: Something went wrong while deleting the entry.'
            ], 500);
        }
    }

    public function getRep($entry_id)
    {
        $entry = Entry::findOrFail($entry_id);
        $rep = $entry->rep;

        return response()->json($rep);
    }

    public function getProducto($entry_id)
    {
        $entry = Entry::findOrFail($entry_id);
        $producto = $entry->producto;

        return response()->json($producto);
    }
}
