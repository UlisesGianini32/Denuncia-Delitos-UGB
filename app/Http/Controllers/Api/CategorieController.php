<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function list(){
        $categorie = Categories::all();
        $list = [];

        foreach($categories as $categorie){
            $object = [
                "id" => $categorie->id,
                "name" => $categorie->name,
                "created_at" => $categorie->created_at,
                "updated_at" => $categorie->updated_at,
            ];
            
            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function item($id){
            $categorie = Categorie::where('id', '=', $id)->first();
                $object = [
                    "id" => $categorie->id,
                    "name" => $categorie->name,
                    "created_at" => $categorie->created_at,
                    "updated_at" => $categorie->updated_at,
                ];
            return response()->json($object);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'categorie' => 'required'
        ]);

        $categorie=Categorie::create([
            'categorie' => $data['categorie']
        ]);
        if($categorie){
            return response()->json([
                'message' => 'Se ha creado un registro',
                'data' => $categorie
            ]);
        }else{
            return response()->json([
                'message' => 'Error al crear el registro',
            ]);
        }
    }
    
    public function update(Request $request){
        
        $data = $request->validate([
            'id' => 'required|integer|min1',
            'name' => 'required'
            ]);

            $categorie = Categorie::where('id', '=', $data['id'])->first();

            if($categorie){
                $categorie->date=$data['name'];
                if($date->save()){
                    $object =
                    [
                        "response" => 'susces, Item update correctly',
                        "old" => $old,
                        "new" => $date,
                    ];
                    return response()->json($object);
                }else{
                    $object =
                    [
                        "response" =>'Error: stupid',
                    ];
                    return response()->json($object);
                }
            }else{
                $object = 
                [
                    "response" => 'Error: stupid'
                ];
                return response()->json($object);
            }
        }
        public function Elements($id){
            $categorie = Categorie::where('id', '=', $id)->get();
            
            $categorieArray = [];
            foreach($categorie as $categorie){
                $categorieArray = [
                    "id" => $categorie->id,
                    "name" => $categorie->Name,
                    "created_at" => $categorie->Created_at,
                    "updated_at" => $categorie->Updated_at,
                ];
            }    
            
            return response()->json($object);
        }
}
