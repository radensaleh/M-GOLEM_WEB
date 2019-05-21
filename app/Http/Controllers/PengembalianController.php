<?php

namespace App\Http\Controllers;

use DB;
use App\Peminjaman;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
  public function showDataPengembalian(Request $request){
      $username = $request->session()->get('usernameTeknisi');
      $nama_teknisi = DB::table('tb_teknisi')->where('username', $username)->value('nama_teknisi');

      $pinjam = Peminjaman::all()->where('status', '==', 0);
      return view("teknisi.dataPengembalian", compact('nama_teknisi', 'pinjam'));
  }
}
