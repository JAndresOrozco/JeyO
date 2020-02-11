<?php

namespace App\Http\Controllers\Tables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Modelos\Proveedor;
class ProveedoresController extends Controller
{
    public function save(Request $request){

        $request->validate([
            "name"=>"required|String",
        ]);

        $supplier = new \App\Modelos\Proveedor();
        $supplier->name = $request->name;
        if($supplier->save())
            return response()->json($supplier,202);
        return response()->json(null,422);
    }

    public function update(Request $request){

        $supplier = \App\Modelos\Proveedor::find($request->id);
        $supplier->name = $request->name;

        if($supplier->save())
            return response()->json($supplier,202);
        return response()->json(null,422);
    }

    public function delete(Request $request){
        $supplier = \App\Modelos\Proveedor::find($request->id);
        if($supplier->delete())
            return response()->json($supplier,202);
        return response()->json(null,422);
    }

    public function index(){
        $data = \App\Modelos\Proveedor::all()->toArray();

        return view('proveedores',["datos" => $data]);
    }

    public function show(){
        $data = \App\Modelos\Proveedor::all()->toArray();

        return $data;
    }
}
