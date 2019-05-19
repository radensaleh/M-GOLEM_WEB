<?php

namespace App\Http\Controllers;

use DB;
use App\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function showDataPeminjaman(Request $request){
        $username = $request->session()->get('usernameTeknisi');
        $nama_teknisi = DB::table('tb_teknisi')->where('username', $username)->value('nama_teknisi');

        // $pinjam = DB::table('tb_peminjaman')->where('status', 1)->orWhere('status', 2)->orWhere('status', 3)->get();
        $pinjam = Peminjaman::all()->where('status', '<=', 3);
        return view("teknisi.dataPeminjaman", compact('nama_teknisi', 'pinjam'));
    }

    public function pdfPinjam(){
        $pinjam = Peminjaman::all();
        $pdf    = PDF::loadView('teknisi.pdfPeminjaman', compact('pinjam'));
        return $pdf->download('Data Peminjaman');
    }
}
