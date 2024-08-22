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
        $product = Product::where('product_id', $product_id)->first(); // Cambiado de Lot a Product

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

    public function update(Request $request, $product_id) {
        $product = Product::find($product_id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $entrada = $request->input('entrada');
        
        // Actualizar entrada y existencia
        $product->entrada += $entrada;
        $product->existencia += $entrada;

        if ($product->save()) {
            return response()->json(['message' => 'Producto actualizado correctamente']);
        } else {
            return response()->json(['message' => 'Error al actualizar el producto'], 500);
        }
    }

    public function create(Request $request)
    {
        // Validación de los datos
        $data = $request->validate([
            'codigo' => 'required|alpha_num',
            'nombre' => 'required|string',
            'expiracion' => 'required|string',
            'stock_inicial' => 'required|numeric',
            'entrada' => 'required|numeric',
            'salida' => 'required|numeric',
            'existencia' => 'required|numeric',
        ]);
    
        try {
            // Crear el producto
            $product = Product::create($data);
    
            if ($product) {
                // Si el producto fue creado, devolver un código 201
                return response()->json([
                    'message' => 'Successfully created product',
                    'data' => $product
                ], 201);
            } else {
                // Si no se pudo crear el producto
                return response()->json([
                    'message' => 'Product could not be created',
                ], 500);
            }
        } catch (\Exception $e) {
            // Capturar cualquier excepción y devolver el error
            return response()->json([
                'message' => 'Error: Unable to create product',
                'error' => $e->getMessage()
            ], 500);
        }
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
        try {
            // Buscar el producto por su ID
            $product = Product::find($product_id);
    
            // Si el producto no se encuentra, devolver un error 404
            if (!$product) {
                return response()->json([
                    'message' => 'Error: Product not found.'
                ], 404);
            }
    
            // Intentar eliminar el producto
            if ($product->delete()) {
                return response()->json([
                    'message' => 'Product deleted successfully'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Error: Unable to delete product.'
                ], 500);
            }
        } catch (\Exception $e) {
            // Capturar cualquier excepción y devolver el mensaje de error
            return response()->json([
                'message' => 'Error: Something went wrong while deleting the product.',
                'error' => $e->getMessage() // Devolver el mensaje de la excepción
            ], 500);
        }
    }    
}
