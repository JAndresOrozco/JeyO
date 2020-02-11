<?php

namespace App\Http\Controllers\Tables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use \App\User;
use \App\Modelos\Producto;
use DB;

class ProductosController extends Controller
{
    public function save(Request $request){
        $request->validate([
            "name"=>"required|String",
            "description"=>"required|String",
            "category_id"=>"required|Integer",
            "price"=>"required|Integer",
            "supplier_id"=>"required|Integer"
        ]);

        $product = new \App\Modelos\Producto();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->supplier_id = $request->supplier_id;
        if($product->save())
            $data = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->select('products.*', 'categories.name as category', 'suppliers.name as supplier')
            ->orderBy('id','desc')
            ->first();
            return response()->json($data,202);
        return response()->json(null,422);
    }

    public function update(Request $request){
        $request->validate([
            "name"=>"required|String",
            "description"=>"required|String",
            "category_id"=>"required|Integer",
            "price"=>"required|Integer",
            "supplier_id"=>"required|Integer"
        ]);
        $product = \App\Modelos\Producto::find($request->id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->supplier_id = $request->supplier_id;

        if($product->save())
            $data = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('suppliers', 'products.supplier_id', '=', '.suppliers.id')
            ->select('products.*', 'categories.name as category', 'suppliers.name as supplier')
            ->orderBy('id','desc')
            ->get();
            return response()->json($data,202);
        return response()->json(null,422);
    }

    public function delete(Request $request){
        $product = \App\Modelos\Producto::find($request->id);
        if($product->delete())
            return response()->json($product,202);
        return response()->json(null,422);
    }

    public function index(){
        $data = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->select('products.*', 'categories.name as category', 'suppliers.name as supplier')
            ->orderBy('id','desc')
            ->get();

        $categories = DB::table('categories')
            ->select('categories.*')
            ->get();

        $suppliers = DB::table('suppliers')
            ->select('suppliers.*')
            ->get();

        return view('productos',["datos" => $data,"categories" => $categories, "suppliers" => $suppliers]);
    }

    public function show(){
        $data = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->select('products.*', 'categories.name as category', 'suppliers.name as supplier')
            ->orderBy('id','desc')
            ->get();

        $categories = DB::table('categories')
            ->select('categories.*')
            ->get();

        $suppliers = DB::table('suppliers')
            ->select('suppliers.*')
            ->get();

        return $data;
    }
}
