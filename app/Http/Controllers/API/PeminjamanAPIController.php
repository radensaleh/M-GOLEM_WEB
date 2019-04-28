<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Peminjaman;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PeminjamanAPIController extends Controller
{
    public function getPeminjaman(Request $request)
    {
        $status = request()->status;

        if ($status == null) {
            $peminjam = Peminjaman::all();
        } else {
            $peminjam = DB::table('tb_peminjaman')->where('status', $status)->get();
        }



        if ($peminjam != null) {
            return response()->json(
                //'errorRes' => 0,
                $peminjam
            );
        } else { }
    }


    public function verifPeminjaman()
    {
        $id = request()->id;

        $status = DB::table('tb_peminjaman')->where('id_pinjam', $id)->value('status');

        if ($status == '1') {
            DB::table('tb_peminjaman')->where('id_pinjam', $id)->update(['status' => '2']);
            return response()->json([
                'errorRes' => 0,
                'message' => 'Berhasil verifikasi peminjaman'
            ]);
        } else if ($status == '3') {
            DB::table('tb_peminjaman')->where('id_pinjam', $id)->update(['status' => '0']);
            return response()->json([
                'errorRes' => 0,
                'message' => 'Berhasil verifikasi pengembalian'
            ]);
        }
    }

    public function peminjaman(Request $request)
    {
        $no = DB::table('tb_penomoran')->where('id', '1')->value('peminjaman');
        $no++;
        $peminjaman = [
            'id_pinjam' => 'PM' . $no,
            'nim' => $request->nim,
            'id_barang' => $request->id_barang,
            'nama_kegiatan' => $request->nama_kegiatan,
            'tgl_pinjam' => $request->tgl_pinjam,
            'status' => $request->status
        ];

        $messages = [
            "nim.required" => "NIM kosong",
            "nim.exists" => "NIM salah",
            "nim.numeric" => "Format NIM salah",

            "id_barang.exists" => "Barang tidak ada",
            "nama_kegiatan.required" => "Nama kegiatan harus diisi",
            "tgl_pinjam.required" => "Tanggal peminjaman harus diisi"
        ];

        $validator = Validator::make($peminjaman, [
            'nim' => 'required|numeric|string|exists:tb_mahasiswa,nim|digits:7',

            'nama_kegiatan' => 'required',
            'tgl_pinjam' => 'required|date',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errorRes' => 1,
                'message' => $validator->messages()->all()[0]
            ]);
        } else {
            $create = Peminjaman::create($peminjaman);
            if ($create) {
                DB::table('tb_penomoran')->where('id', 1)->update(['peminjaman' => $no]);
                return response()->json([
                    'errorRes' => 0,
                    'message' => 'Berhasil'
                ]);
            }
        }
    }
}
