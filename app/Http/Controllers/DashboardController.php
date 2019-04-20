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
           $kembali = Peminjaman::count();

           $username = $request->session()->get('usernameTeknisi');
           $nama_teknisi = DB::table('tb_teknisi')->where('username', $username)->value('nama_teknisi');
           return view('teknisi.dashboard', compact(
              'nama_teknisi', 'mhs', 'barang', 'pinjam', 'kembali'
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
