<?php

namespace App\Http\Controllers\Tables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use \App\Modelos\Venta;
class VentasController extends Controller
{
    public function index(){
        $data = DB::table('sales')
        ->join('salesdetails', 'sales.saledetail_id', '=', 'salesdetails.id')
        ->join('users', 'sales.user_id', '=', 'users.id')
        ->select('sales.*', 'salesdetails.id as saledetail', 'users.username as user')
        ->orderBy('id','desc')
            ->get();
        
        $salesdetails = DB::table('salesdetails')
            ->select('salesdetails.*')
            ->get();

        $users = DB::table('users')
        ->select('users.*')
        ->get();
    
        return view('ventas',["datos" => $data,"salesdetails" => $salesdetails, "users" => $users]);
    }
    public function save(Request $request){
        $request->validate([
            "saledetail_id"=>"required|Integer",
            "user_id" => "required|Integer"
        ]);

        $sale = new \App\Modelos\Venta();
        $sale->saledetail_id = $request->saledetail_id;
        $sale->user_id = $request->user_id;
        if($sale->save())
            $data = DB::table('sales')
            ->join('salesdetails', 'sales.saledetail_id', '=', 'salesdetails.id')
            ->join('users', 'sales.user_id', '=', 'users.id')
            ->select('sales.*', 'salesdetails.id as saledetail', 'users.username as user')
            ->orderBy('id','desc')
            ->first();
            return response()->json($data,202);
        return response()->json(null,422);
    }

    public function update(Request $request){

        $sale = \App\Modelos\Venta::find($request->id);
        $sale->saledetail_id = $request->sale['saledetail_id'];
        $sale->user_id = $request->sale['user_id'];
    
        if($sale->save())
            $data = DB::table('sales')
            ->join('salesdetails', 'sales.saledetail_id', '=', 'salesdetails.id')
            ->join('users', 'sales.user_id', '=', 'users.id')
            ->select('sales.*', 'salesdetails.id as saledetail', 'users.username as user')
            ->orderBy('id','desc')
            ->get();
            return response()->json($data,202);
        return response()->json(null,422);
    }

    public function delete(Request $request){
        $sale = \App\Modelos\Venta::find($request->id);
        if($sale->delete())
            return response()->json($sale,202);
        return response()->json(null,422);
    }

}
