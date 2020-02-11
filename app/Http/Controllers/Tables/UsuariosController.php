<?php

namespace App\Http\Controllers\Tables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use \App\Modelos\Usuario;
class UsuariosController extends Controller
{
    public function save(Request $request){
        $request->validate([
            "username"=>"required|String",
            "email"=>"required|String",
            "password"=>"required",
            "status"=>"required|Integer"
        ]);

        $user = new \App\Modelos\Usuario();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = $request->status;
        if($user->save())
            $data = DB::table('users')
            ->select('users.*')
            ->orderBy('id','desc')
                ->first();
            return response()->json($data,202);
        return response()->json(null,422);
    }

    public function update(Request $request){

        $user = \App\Modelos\Usuario::find($request->id);
        $user->username = $request->user['username'];
        $user->email = $request->user['email'];
        $user->password = bcrypt($request->password);
        $user->status = $request->user['status'];

        if($user->save())
            $data = DB::table('users')
            ->select('users.*')
            ->orderBy('id','desc')
            ->get();
            return response()->json($data,202);
        return response()->json(null,422);
    }

    public function delete(Request $request){
        $user = \App\Modelos\Usuario::find($request->id);
        if($user->delete())
            return response()->json($user,202);
        return response()->json(null,422);
    }

    public function index(){
        $data = DB::table('users')
        ->select('users.*')
        ->orderBy('id','desc')
            ->get();

        return view('usuarios',["datos" => $data]);
    }
    public function show(){
        $data = DB::table('users')
        ->select('users.*')
        ->orderBy('id','desc')
            ->get();

        return $data;
    }
    public function activarToken(Request $request){
        $token = Str::random(80);

        Auth::user()->forceFill([
            'remember_token' => $token,
            'api_token' => hash('sha256', $token),
        ])->save();

        return ['token' => $token];
    }
    public function desactivarToken(Request $request){
        Auth::user()->forceFill([
            'remember_token' => null,
            'api_token' => null,
        ])->save();

        return 'done';

    }
}
