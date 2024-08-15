<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list(Request $request)
{
    $products = Product::all();
    $list = [];

    foreach ($products as $product) {
        $object = [
            "product_id" => $product->product_id, // Aquí se corrige "produc_id" por "product_id"
            "codigo" => $product->codigo,
            "nombre" => $product->nombre,
            "expiracion" => $product->expiracion,
            "stock_inicial" => $product->stock_inicial,
            "entrada" => $product->entrada,
            "salida" => $product->salida,
            "existencia" => $product->existencia,
            "created_at" => $product->created_at,
            "updated_at" => $product->updated_at
        ];

        array_push($list, $object);
    }

    return response()->json($list);
}


    public function item($product_id)
    {
        $product = Product::where('id', $id)->first(); // Cambiado de Lot a Product

        if (!$product) {
            return response()->json([
                'message' => 'Item not found',
            ], 404);
        }

        $object = [
            "product_id" => $product->product_id,
            "codigo" => $product->codigo,
            "nombre" => $product->nombre,
            "expiracion" => $product->expiracion,
            "stock_inicial" => $product->stock_inicial,
            "entrada" => $product->entrada,
            "salida" => $product->salida,
            "existencia" => $product->existencia,
            "created_at" => $product->created_at,
            "updated_at" => $product->updated_at
        ];

        return response()->json($object);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|numeric',
            'codigo' => 'required|alpha_num',
            'nombre' => 'required|string',
            'expiracion' => 'required|date',
            'stock_inicial' => 'required|numeric',
            'entrada' => 'required|numeric',
            'salida' => 'required|numeric',
            'existencia' => 'required|numeric',
        ]);

        $product = Product::find($data['product_id']); // Cambiado de Lot a Product

        if (!$product) {
            return response()->json([
                'message' => 'Item not found',
            ], 404);
        }

        if ($product->update($data)) {
            return response()->json([
                'message' => 'Successfully updated product',
                'data' => $product
            ]);
        } else {
            return response()->json([
                'message' => 'Error unable to save product',
                'data' => 'try again later'
            ]);
        }
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'codigo' => 'required|alpha_num',
            'nombre' => 'required|string',
            'expiracion' => 'required|date',
            'stock_inicial' => 'required|numeric',
            'entrada' => 'required|numeric',
            'salida' => 'required|numeric',
            'existencia' => 'required|numeric',
        ]);

        $product = Product::create($data); // Cambiado de Lot a Product

        return response()->json([
            'message' => 'Successfully created product',
            'data' => $product
        ], 201);
    }

    public function Elements($product_id)
    {
        $products = Product::where('product_id', $product_id)->get(); // Cambiado de Lot a Product

        $productArray = [];

        foreach ($products as $product) {
            $productArray[] = [
                "product_id" => $product->product_id,
                "codigo" => $product->codigo,
                "nombre" => $product->nombre,
                "expiracion" => $product->expiracion,
                "stock_inicial" => $product->stock_inicial,
                "entrada" => $product->entrada,
                "salida" => $product->salida,
                "existencia" => $product->existencia,
                "created_at" => $product->created_at,
                "updated_at" => $product->updated_at,
            ];
        }

        return response()->json($productArray);
    }

    public function searchProducts($searchTerm) { // Cambiado de searchLots a searchProducts
        $products = Product::where('nombre', 'like', '%' . $searchTerm . '%') // Cambiado de productos a nombre
            ->latest()
            ->get();

        $resultArray = [];

        foreach ($products as $product) {
            $productDetails = [
                "product_id" => $product->product_id,
                "codigo" => $product->codigo,
                "nombre" => $product->nombre,
                "expiracion" => $product->expiracion,
                "stock_inicial" => $product->stock_inicial,
                "entrada" => $product->entrada,
                "salida" => $product->salida,
                "existencia" => $product->existencia,
            ];
            $resultArray[] = $productDetails;
        }

        return response()->json($resultArray);
    }

    public function delete($product_id) {
        $product = Product::find($product_id); // Cambiado de Lot a Product

        if (!$product) {
            return response()->json([
                'message' => 'Error: Element not found.'
            ], 404);
        }

        if ($product->delete()) {
            return response()->json([
                'message' => 'Product deleted successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Error: Something went wrong while deleting the product.'
            ], 500);
        }
    }
}
