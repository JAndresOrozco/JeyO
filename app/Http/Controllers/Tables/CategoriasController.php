<?php

namespace App\Http\Controllers\Tables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use \App\Modelos\Categoria;
class CategoriasController extends Controller
{
    public function index(){
        $data = \App\Modelos\Categoria::all()->toArray();
        return view('categorias',["datos" => $data]);
    }

    public function save(Request $request){
        $request->validate([
            "name"=>"required|String",
            "description"=>"required"
        ]);

        $category = new \App\Modelos\Categoria();
        $category->name = $request->name;
        $category->description = $request->description;
        
        if($category->save())
            return response()->json($category,202);
        return response()->json(null,422);
    }

    public function update(Request $request){

        $category = \App\Modelos\Categoria::find($request->id);
        $category->name = $request->name;
        $category->description = $request->description;
    
        if($category->save())
            return response()->json($category,202);
        return response()->json(null,422);
    }

    public function delete(Request $request){
        $category = \App\Modelos\Categoria::find($request->id);
        if($category->delete())
            return response()->json($category,202);
        return response()->json(null,422);
    }

    
}
