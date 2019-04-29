<?php

namespace App\Http\Controllers;

use DB;
use App\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function showDtKelasAdmin(Request $request){
        $username = $request->session()->get('usernameAdmin');
        $nama_admin = DB::table('tb_admin')->where('username', $username)->value('nama');

        $kelas = Kelas::all();
        return view('adminWeb.dataKelas', compact('nama_admin', 'kelas'));
    }

    public function store(Request $request){
        $checkIfExist = Kelas::where('id_kelas', $request->id_kelas)->get();

        if( count($checkIfExist) != 0 ){
          return response()->json([
             'error' => 1,
             'message' => 'Id Kelas Already Exist'
           ], 200);
        }

        $create = Kelas::create($request->all());
        if( $create ) {
           return response()->json([
             'error' => 0,
             'message' => 'Success Add Data'
           ], 200);
      }
    }

    public function update(Request $request){
        $data = Kelas::findOrFail($request->id_kelas);
        $data->update($request->all());

        if( $data ){
          return response()->json([
            'error' => 0,
            'message' => 'Success Edit Data'
          ], 200);
        }
    }

    public function destroy(Request $request){
         $data = Kelas::findOrFail($request->id_kelas);

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
