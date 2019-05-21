<?php

namespace App\Http\Controllers;

use DB;
use App\Mahasiswa;
use App\Teknisi;
use App\Barang;
use App\Type;
use App\Merk;
use App\Kategori;
use App\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // --------------------- TEKNISI ---------------------- //
    public function showDashboard(Request $request){
       if(!$request->session()->exists('usernameTeknisi')){
           return redirect()->route('login');
       }else{
           $mhs     = Mahasiswa::count();
           $barang  = Barang::count();
           $pinjam  = Peminjaman::count();
           $kembali = Peminjaman::where('status', '=', '0')->count();

           $pinjam_jan = Peminjaman::whereMonth('tgl_pinjam', '=', 1)->whereYear('tgl_pinjam', '=', 2019)->count();
           $pinjam_feb = Peminjaman::whereMonth('tgl_pinjam', '=', 2)->whereYear('tgl_pinjam', '=', 2019)->count();
           $pinjam_mar = Peminjaman::whereMonth('tgl_pinjam', '=', 3)->whereYear('tgl_pinjam', '=', 2019)->count();
           $pinjam_apr = Peminjaman::whereMonth('tgl_pinjam', '=', 4)->whereYear('tgl_pinjam', '=', 2019)->count();
           $pinjam_mei = Peminjaman::whereMonth('tgl_pinjam', '=', 5)->whereYear('tgl_pinjam', '=', 2019)->count();
           $pinjam_jun = Peminjaman::whereMonth('tgl_pinjam', '=', 6)->whereYear('tgl_pinjam', '=', 2019)->count();
           $pinjam_jul = Peminjaman::whereMonth('tgl_pinjam', '=', 7)->whereYear('tgl_pinjam', '=', 2019)->count();
           $pinjam_agt = Peminjaman::whereMonth('tgl_pinjam', '=', 8)->whereYear('tgl_pinjam', '=', 2019)->count();
           $pinjam_sep = Peminjaman::whereMonth('tgl_pinjam', '=', 9)->whereYear('tgl_pinjam', '=', 2019)->count();
           $pinjam_okt = Peminjaman::whereMonth('tgl_pinjam', '=', 10)->whereYear('tgl_pinjam', '=', 2019)->count();
           $pinjam_nov = Peminjaman::whereMonth('tgl_pinjam', '=', 11)->whereYear('tgl_pinjam', '=', 2019)->count();
           $pinjam_des = Peminjaman::whereMonth('tgl_pinjam', '=', 12)->whereYear('tgl_pinjam', '=', 2019)->count();
           $pinjam_2019 = Peminjaman::whereYear('tgl_pinjam', '=', 2019)->count();

           $username = $request->session()->get('usernameTeknisi');
           $nama_teknisi = DB::table('tb_teknisi')->where('username', $username)->value('nama_teknisi');
           return view('teknisi.dashboard', compact(
              'nama_teknisi', 'mhs', 'barang', 'pinjam', 'kembali',
              'pinjam_jan','pinjam_feb', 'pinjam_mar', 'pinjam_apr', 'pinjam_mei', 'pinjam_jun', 'pinjam_jul',
              'pinjam_agt','pinjam_sep','pinjam_okt','pinjam_nov','pinjam_des','pinjam_2019'
           ));
       }
    }

    public function logout(Request $request){
      $request->session()->forget('usernameTeknisi');
      return redirect()->route('login');
    }


    // --------------------- ADMIN ---------------------- //
    public function showDashboardAdmin(Request $request){
       if(!$request->session()->exists('usernameAdmin')){
           return redirect()->route('loginAdmin');
       }else{
           $mhs     = Mahasiswa::count();
           $teknisi = Teknisi::count();
           $barang  = Barang::count();
           $merk    = Merk::count();
           $type    = Type::count();
           $kategori= Kategori::count();

           $username = $request->session()->get('usernameAdmin');
           $nama_admin = DB::table('tb_admin')->where('username', $username)->value('nama');
           return view('adminWeb.dashboard', compact(
             'nama_admin', 'mhs', 'teknisi', 'barang', 'merk', 'type', 'kategori'
           ));
       }
    }

    public function logoutAdmin(Request $request){
      $request->session()->forget('usernameAdmin');
      return redirect()->route('loginAdmin');
    }

}
