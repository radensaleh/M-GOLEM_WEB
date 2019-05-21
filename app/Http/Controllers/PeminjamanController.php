<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use App\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function showDataPeminjaman(Request $request)
    {
        $username = $request->session()->get('usernameTeknisi');
        $nama_teknisi = DB::table('tb_teknisi')->where('username', $username)->value('nama_teknisi');

        // $pinjam = DB::table('tb_peminjaman')->where('status', 1)->orWhere('status', 2)->orWhere('status', 3)->get();
        $pinjam = Peminjaman::all()->where('status', '>', 0);
        return view("teknisi.dataPeminjaman", compact('nama_teknisi', 'pinjam'));
    }

    public function pdfPinjam()
    {
        // $pinjam = Peminjaman::all();
        $pinjam = DB::table('tb_peminjaman')
            ->select('tb_peminjaman.id_pinjam', 'tb_mahasiswa.nama_mhs', 'nama_kegiatan', 'tgl_pinjam', 'tgl_kembali', 'tb_teknisipinjam.nama_teknisi as teknisi_pinjam', 'tb_teknisikembali.nama_teknisi as teknisi_kembali')
            ->join('tb_mahasiswa', 'tb_mahasiswa.nim', '=', 'tb_peminjaman.nim')
            ->join('tb_teknisi as tb_teknisipinjam', 'tb_teknisipinjam.username', '=', 'tb_peminjaman.username_verifpinjam')
            ->join('tb_teknisi as tb_teknisikembali', 'tb_teknisikembali.username', '=', 'tb_peminjaman.username_verifkembali')
            //->join('tb_daftar_barang', 'tb_daftar_barang.id_pinjam', '=', 'tb_peminjaman.id_pinjam')
            ->where('status', '=', '0')
            ->get();

        $daftar_barang = DB::table('tb_daftar_barang')->get();
        $barang = DB::table('tb_barang')
                ->select('tb_barang.id_barang','tb_tipe.nama_tipe', 'tb_merk.nama_merk', 'tb_kategori.nama_kategori')
                ->join('tb_tipe', 'tb_tipe.id_tipe', '=', 'tb_barang.id_tipe')
                ->join('tb_merk', 'tb_merk.id_merk', '=', 'tb_barang.id_merk')
                ->join('tb_kategori', 'tb_kategori.id_kategori', '=', 'tb_barang.id_kategori')
                ->get();

        // $data = DB::table('tb_barang')
        //         ->select('tb_tipe.nama_tipe', 'tb_merk.nama_merk', 'tb_kategori.kategori')
        //         ->join('tb_tipe', 'tb_tipe.id_tipe', '=', 'tb_barang.id_tipe')
        //         ->join('tb_merk', 'tb_merk.id_merk', '=', 'tb_barang.id_merk')
        //         ->join('tb_kategori', 'tb_kategori.id_kategori', '=', 'tb_barang.id_kategori')
        //         ->get();

        $pdf    = PDF::loadView('teknisi.pdfPeminjaman', compact('pinjam', 'daftar_barang', 'barang'));
        return $pdf->download('Data Peminjaman');
    }
}
