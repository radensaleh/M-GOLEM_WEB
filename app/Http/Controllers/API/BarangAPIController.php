<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Barang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BarangAPIController extends Controller
{
    public function getBarang()
    {
        $id = request()->id;

        $barang   = DB::table('tb_barang')->where('id_barang', $id)->first();

        if ($barang != null) {
            $tipe     = DB::table('tb_tipe')->where('id_tipe', $barang->id_tipe)->value('nama_tipe');
            $kategori = DB::table('tb_kategori')->where('id_kategori', $barang->id_kategori)->value('nama_kategori');
            $merk     = DB::table('tb_merk')->where('id_merk', $barang->id_merk)->value('nama_merk');

            return response()->json([
                'tipe' => $tipe,
                'kategori' => $kategori,
                'merk' => $merk,
                'kuantitas' => $barang->kuantitas
            ]);
        } else {
            return response()->json([
                'tipe' => null
            ]);
        }
    }

    public function getBarangAll()
    {
        $barang = DB::table('tb_barang')->get();

        if ($barang == null) {
            return response()->jso([
                'tipe' => null
            ]);
        } else {
            foreach ($barang as $data) {
                $tipe     = DB::table('tb_tipe')->where('id_tipe', $data->id_tipe)->value('nama_tipe');
                $kategori = DB::table('tb_kategori')->where('id_kategori', $data->id_kategori)->value('nama_kategori');
                $merk     = DB::table('tb_merk')->where('id_merk', $data->id_merk)->value('nama_merk');

                $data->tipe = $tipe;
                $data->kategori = $kategori;
                $data->merk = $merk;
            }
            return response()->json(
                $barang
            );
        }
    }
}
