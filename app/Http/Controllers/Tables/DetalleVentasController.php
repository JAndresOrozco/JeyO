<?php

namespace App\Http\Controllers\Tables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class DetalleVentasController extends Controller
{
    public function index(){
        $data = DB::table('salesdetails')
        ->join('products', 'salesdetails.product_id', '=', 'products.id')
        ->select('salesdetails.*', 'products.name as product')
        ->orderBy('id','desc')
            ->get();

        $products = DB::table('products')
            ->select('products.*')
            ->get();

        return view('detalle',["datos" => $data,"products" => $products]);
    }

    public function show(){
        $data = DB::table('salesdetails')
        ->join('products', 'salesdetails.product_id', '=', 'products.id')
        ->select('salesdetails.*', 'products.name as product')
        ->orderBy('id','desc')
            ->get();

        $products = DB::table('products')
            ->select('products.*')
            ->get();

        return $data;
    }
    public function save(Request $request){
        $request->validate([
            "quantity"=>"required|Integer",
            "price"=>"required|Integer",
            "product_id"=>"required|Integer"
        ]);

        $sale = new \App\Modelos\DetalleVenta();
        $sale->quantity = $request->quantity;
        $sale->price = $request->price;
        $sale->product_id = $request->product_id;
        if($sale->save())
            $data = DB::table('salesdetails')
            ->join('products', 'salesdetails.product_id', '=', 'products.id')
            ->select('salesdetails.*', 'products.name as product')
            ->orderBy('id','desc')
            ->first();
            return response()->json($data,202);
        return response()->json(null,422);
    }

    public function update(Request $request){

        $sale = \App\Modelos\DetalleVenta::find($request->id);
        $sale->quantity = $request->quantity;
        $sale->price = $request->price;
        $sale->product_id = $request->product_id;

        if($sale->save())
            $data = DB::table('salesdetails')
            ->join('products', 'salesdetails.product_id', '=', 'products.id')
            ->select('salesdetails.*', 'products.name as product')
            ->orderBy('id','desc')
            ->get();
            return response()->json($data,202);
        return response()->json(null,422);
    }

    public function delete(Request $request){
        $sale = \App\Modelos\DetalleVenta::find($request->id);
        if($sale->delete())
            return response()->json($sale,202);
        return response()->json(null,422);
    }


}
