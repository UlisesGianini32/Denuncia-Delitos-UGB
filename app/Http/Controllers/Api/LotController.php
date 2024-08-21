<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lot;
use Illuminate\Http\Request;

class LotController extends Controller
{
    public function list(Request $request)
    {
        $lots = Lot::all();
        $list = [];

        foreach ($lots as $lot) {
            $object = [
                "lot_id" => $lot->lot_id,
                "codigo" => $lot->codigo,
                "rpe" => $lot->rpe,
                "productos" => $lot->productos,
                "cantidad" => $lot->cantidad,
                "productos_2" => $lot->productos_2,
                "cantidad_2" => $lot->cantidad_2,
                "productos_3" => $lot->productos_3,
                "cantidad_3" => $lot->cantidad_3,
                "productos_4" => $lot->productos_4,
                "cantidad_4" => $lot->cantidad_4,
                "imagen" => $lot->imagen,
                "firma" => $lot->firma,
                "rpe2" => $lot->rpe2,
                "created_at" => $lot->created_at,
                "updated_at" => $lot->updated_at
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($lot_id)
    {
        $lot = Lot::where('lot_id', $lot_id)->first();

        if (!$lot) {
            return response()->json([
                'message' => 'Item not found',
            ], 404);
        }

        $object = [
            "lot_id" => $lot->lot_id,
            "codigo" => $lot->codigo,
            "rpe" => $lot->rpe,
            "productos" => $lot->productos,
            "cantidad" => $lot->cantidad,
            "productos_2" => $lot->productos_2,
            "cantidad_2" => $lot->cantidad_2,
            "productos_3" => $lot->productos_3,
            "cantidad_3" => $lot->cantidad_3,
            "productos_4" => $lot->productos_4,
            "cantidad_4" => $lot->cantidad_4,
            "imagen" => $lot->imagen,
            "firma" => $lot->firma,
            "rpe2" => $lot->rpe2,
            "created_at" => $lot->created_at,
            "updated_at" => $lot->updated_at
        ];

        return response()->json($object);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'lot_id' => 'required|numeric',
            'codigo' => 'required|alpha_num',
            'rpe' => 'required',
            'productos' => 'required',
            'cantidad' => 'required|numeric',
            'productos_2' => 'required',
            'cantidad_2' => 'required|numeric',
            'productos_3' => 'required',
            'cantidad_3' => 'required|numeric',
            'productos_4' => 'required',
            'cantidad_4' => 'required|numeric',
            'imagen' => 'required',
            'firma' => 'required',
            'rpe2' => 'required|numeric',
        ]);

        $lot = Lot::find($data['lot_id']);

        if (!$lot) {
            return response()->json([
                'message' => 'Item not found',
            ], 404);
        }

        if($lot->update($data)){
            return response()->json([
                'message' => 'Successfully updated lot',
                'data' => $lot
            ]);
        } else {
            return response()->json([
                'message' => 'Error unable to save lot',
                'data' => 'try again later'
            ]);
        }
    }

    public function create(Request $request)
{
    $data = $request->validate([
        'codigo' => 'required|alpha_num',
        'rpe' => 'required',
        'productos' => 'required',
        'cantidad' => 'required|numeric',
        'productos_2' => 'required',
        'cantidad_2' => 'required|numeric',
        'productos_3' => 'required',
        'cantidad_3' => 'required|numeric',
        'productos_4' => 'required',
        'cantidad_4' => 'required|numeric',
        'imagen' => 'required',
        'firma' => 'required',
        'rpe2' => 'required|numeric',
    ]);

    try {
        // Intentar crear el lote
        $lot = Lot::create($data);

        return response()->json([
            'message' => 'Successfully created lot',
            'data' => $lot
        ], 201);
    } catch (\Exception $e) {
        // En caso de fallo, devolver una respuesta de error
        return response()->json([
            'message' => 'Failed to create lot',
            'error' => $e->getMessage()
        ], 500);
    }
}


    public function Elements($lot_id)
    {
        $lots = Lot::where('lot_id', $lot_id)->get();

        $lotArray = [];

        foreach ($lots as $lot) {
            $lotArray[] = [
                "lot_id" => $lot->lot_id,
                "codigo" => $lot->codigo,
                "rpe" => $lot->rpe,
                "productos" => $lot->productos,
                "cantidad" => $lot->cantidad,
                "productos_2" => $lot->productos_2,
                "cantidad_2" => $lot->cantidad_2,
                "productos_3" => $lot->productos_3,
                "cantidad_3" => $lot->cantidad_3,
                "productos_4" => $lot->productos_4,
                "cantidad_4" => $lot->cantidad_4,
                "imagen" => $lot->imagen,
                "firma" => $lot->firma,
                "rpe2" => $lot->rpe2,
                "created_at" => $lot->created_at,
                "updated_at" => $lot->updated_at,
            ];
        }

        return response()->json($lotArray);
    }

    public function searchLots($searchTerm) {
        $lots = Lot::where('productos', 'like', '%' . $searchTerm . '%') // Busca por coincidencia en productos
            ->latest()
            ->get();

        $resultArray = [];

        foreach ($lots as $lot) {
            $lotDetails = [
                "lot_id" => $lot->lot_id,
                "codigo" => $lot->codigo,
                "rpe" => $lot->rpe,
                "productos" => $lot->productos,
                "cantidad" => $lot->cantidad,
                "productos_2" => $lot->productos_2,
                "cantidad_2" => $lot->cantidad_2,
                "productos_3" => $lot->productos_3,
                "cantidad_3" => $lot->cantidad_3,
                "productos_4" => $lot->productos_4,
                "cantidad_4" => $lot->cantidad_4,
                "imagen" => $lot->imagen,
                "firma" => $lot->firma,
                "rpe2" => $lot->rpe2,
            ];
            $resultArray[] = $lotDetails; // Agrega los detalles del lote al array resultante
        }

        return response()->json($resultArray); // Devuelve el array completo como JSON
    }

    public function delete($lot_id) {
        $lot = Lot::find($lot_id);

        if (!$lot) {
            return response()->json([
                'message' => 'Error: Element not found.'
            ], 404);
        }

        if ($lot->delete()) {
            return response()->json([
                'message' => 'Lot deleted successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Error: Something went wrong while deleting the post.'
            ], 500);
        }
    }

    public function getProductos($lot_id)
    {
        $lot = Lot::findOrFail($lot_id);
        $productos = $lot->productos;

        return response()->json($productos);
    }

    public function getProductos2($lot_id)
    {
        $lot = Lot::findOrFail($lot_id);
        $productos2 = $lot->productos2;

        return response()->json($productos2);
    }

    public function getProductos3($lot_id)
    {
        $lot = Lot::findOrFail($lot_id);
        $productos3 = $lot->productos3;

        return response()->json($productos3);
    }

    public function getProductos4($lot_id)
    {
        $lot = Lot::findOrFail($lot_id);
        $productos4 = $lot->productos4;

        return response()->json($productos4);
    }
}
