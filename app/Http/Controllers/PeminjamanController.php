<?php

namespace App\Http\Controllers;

use DB;
use PDF;
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
        // $pinjam = Peminjaman::all();
        $pinjam = DB::table('tb_peminjaman')
                  ->select('id_pinjam', 'tb_mahasiswa.nama_mhs', 'nama_kegiatan', 'tgl_pinjam', 'tgl_kembali', 'tb_teknisipinjam.nama_teknisi as teknisi_pinjam', 'tb_teknisikembali.nama_teknisi as teknisi_kembali')
                  ->join('tb_mahasiswa', 'tb_mahasiswa.nim', '=', 'tb_peminjaman.nim')
                  ->join('tb_teknisi as tb_teknisipinjam', 'tb_teknisipinjam.username', '=', 'tb_peminjaman.username_verifpinjam')
                  ->join('tb_teknisi as tb_teknisikembali', 'tb_teknisikembali.username', '=', 'tb_peminjaman.username_verifkembali')
                  ->where('status', '=', '4')
                  ->get();

        $pdf    = PDF::loadView('teknisi.pdfPeminjaman', compact('pinjam'));
        return $pdf->download('Data Peminjaman');
    }
}
