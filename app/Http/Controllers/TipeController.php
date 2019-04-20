<?php

namespace App\Http\Controllers;

use DB;
use App\Type;
use Illuminate\Http\Request;

class TipeController extends Controller
{
    // --------------------- ADMIN ---------------------- //
    public function showDtTipeAdmin(Request $request){
        $username = $request->session()->get('usernameAdmin');
        $nama_admin = DB::table('tb_admin')->where('username', $username)->value('nama');

        $tipe = Type::all();
        return view('adminWeb.dataTipe', compact('nama_admin', 'tipe'));
    }

    public function store(Request $request){
        $checkIfExist = Type::where('id_tipe', $request->id_tipe)->get();

        if( count($checkIfExist) != 0 ){
          return response()->json([
             'error' => 1,
             'message' => 'Id Tipe Already Exist'
           ], 200);
        }

        $create = Type::create($request->all());
        if( $create ) {
           return response()->json([
             'error' => 0,
             'message' => 'Success Add Data'
           ], 200);
      }
    }

    public function update(Request $request){
        $data = Type::findOrFail($request->id_tipe);
        $data->update($request->all());

        if( $data ){
          return response()->json([
            'error' => 0,
            'message' => 'Success Edit Data'
          ], 200);
        }
    }

    public function destroy(Request $request){
         $data = Type::findOrFail($request->id_tipe);

         try {
           $data->delete();

           if( $data ){
             return response()->json([
               'error' => 0,
               'message' => 'Success Delete Data'
             ], 200);
           }
         } catch (\Exception $e) {
             return response()->json([
               'error' => 1,
               'message' => 'Failed Delete Data'
             ], 200);
         }
    }
}
