<?php

namespace App\Http\Controllers;

use DB;
use App\Merk;
use Illuminate\Http\Request;

class MerkController extends Controller
{
    // --------------------- ADMIN ---------------------- //
    public function showDtMerkAdmin(Request $request){
        $username = $request->session()->get('usernameAdmin');
        $nama_admin = DB::table('tb_admin')->where('username', $username)->value('nama');

        $merk = Merk::orderBy('id_merk', 'asc')->get();
        return view('adminWeb.dataMerk', compact('nama_admin', 'merk'));
    }

    public function store(Request $request){
        $checkIfExist = Merk::where('id_merk', $request->id_merk)->get();

        if( count($checkIfExist) != 0 ){
          return response()->json([
             'error' => 1,
             'message' => 'Id Merk Already Exist'
           ], 200);
        }

        $create = Merk::create($request->all());
        if( $create ) {
           return response()->json([
             'error' => 0,
             'message' => 'Success Add Data'
           ], 200);
      }
    }

    public function update(Request $request){
        $data = Merk::findOrFail($request->id_merk);
        $data->update($request->all());

        if( $data ){
          return response()->json([
            'error' => 0,
            'message' => 'Success Edit Data'
          ], 200);
        }
    }

    public function destroy(Request $request){
         $data = Merk::findOrFail($request->id_merk);

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
