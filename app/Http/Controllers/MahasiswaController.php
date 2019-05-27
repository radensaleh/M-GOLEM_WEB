<?php

namespace App\Http\Controllers;

use DB;
use App\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // --------------------- TEKNISI ---------------------- //
    public function showDataMhs(Request $request){
        $username = $request->session()->get('usernameTeknisi');
        $nama_teknisi = DB::table('tb_teknisi')->where('username', $username)->value('nama_teknisi');

        $mahasiswa = Mahasiswa::all();
        return view('teknisi.dataMahasiswa', compact('nama_teknisi', 'mahasiswa'));
    }

    // --------------------- ADMIN ---------------------- //
    public function showDtMhsAdmin(Request $request){
        $username = $request->session()->get('usernameAdmin');
        $nama_admin = DB::table('tb_admin')->where('username', $username)->value('nama');

        $mahasiswa = Mahasiswa::orderBy('nim', 'asc')->get();
        return view('adminWeb.dataMahasiswa', compact('nama_admin', 'mahasiswa'));
    }

    public function destroy(Request $request){
         $data = Mahasiswa::findOrFail($request->nim);

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

    //test
}
