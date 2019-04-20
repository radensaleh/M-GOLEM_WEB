<?php

namespace App\Http\Controllers;

use DB;
use App\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // --------------------- ADMIN ---------------------- //
    public function showDtKategoriAdmin(Request $request){
        $username = $request->session()->get('usernameAdmin');
        $nama_admin = DB::table('tb_admin')->where('username', $username)->value('nama');

        $kategori = Kategori::all();
        return view('adminWeb.dataKategori', compact('nama_admin', 'kategori'));
    }

    public function store(Request $request){
        $checkIfExist = Kategori::where('id_kategori', $request->id_kategori)->get();

        if( count($checkIfExist) != 0 ){
          return response()->json([
             'error' => 1,
             'message' => 'Id Kategori Already Exist'
           ], 200);
        }

        $create = Kategori::create($request->all());
        if( $create ) {
           return response()->json([
             'error' => 0,
             'message' => 'Success Add Data'
           ], 200);
      }
    }

    public function update(Request $request){
        $data = Kategori::findOrFail($request->id_kategori);
        $data->update($request->all());

        if( $data ){
          return response()->json([
            'error' => 0,
            'message' => 'Success Edit Data'
          ], 200);
        }
    }

    public function destroy(Request $request){
         $data = Kategori::findOrFail($request->id_kategori);

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
