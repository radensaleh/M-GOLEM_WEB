<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Peminjaman;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\DaftarBarang;

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

    public function getPeminjamanMhs(Request $request)
    {
        $nim = request()->nim;
        $status = request()->status;

        $messages = [
            "nim.required" => "NIM kosong",
            "nim.exists" => "NIM salah",
            "nim.numeric" => "Format NIM salah"
        ];


        if ($status == null) {
            $peminjam = Peminjaman::all();
        } else {
            $peminjam = DB::table('tb_peminjaman')->where('status', $status)->where('nim', $nim)->get();
            if ($peminjam != null) {
                return response()->json(
                    //'errorRes' => 0,
                    $peminjam
                );
            } else { }
        }
    }

    public function pengembalianPinjam(Request $request)
    {
        $id_pinjam = request()->id_pinjam;
        $messages = [
            "id.required" => "ID kosong",
            "id.exists" => "ID salah",
        ];

        $validator = Validator::make($request->all(), [
            'id_pinjam' => 'required|string|exists:tb_peminjaman,id_pinjam',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errorRes' => 1,
                'messageRes' => $validator->messages()->all()[0],
            ], 200);
        } else {
            $status = DB::table('tb_peminjaman')->where('id_pinjam', $id_pinjam)->value('status');
            if ($status != '2') {
                return response()->json([
                    'errorRes' => 1,
                    'message' => 'Gagal mengubah status peminjaman'
                ], 200);
            } else {
                DB::table('tb_peminjaman')->where('id_pinjam', $id_pinjam)->update(['status' => '3']);
                return response()->json([
                    'errorRes' => 0,
                    'message' => 'Berhasil verifikasi peminjaman'
                ], 200);
            }
        }
    }


    public function verifPeminjaman(Request $request)
    {
        $id_pinjam = request()->id_pinjam;
        $username_pinjam = request()->username;

        $messages = [
            "id.required" => "ID kosong",
            "id.exists" => "ID salah",
            "username_pinjam.required" => "Username anda tiak terdaftar"
        ];

        $validator = Validator::make($request->all(), [
            'id_pinjam' => 'required|string|exists:tb_peminjaman,id_pinjam',
            'username' => 'required|string|exists:tb_teknisi,username',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errorRes' => 1,
                'messageRes' => $validator->messages()->all()[0],
            ], 200);
        } else {
            $status = DB::table('tb_peminjaman')->where('id_pinjam', $id_pinjam)->value('status');

            if ($status == '1') {
                DB::table('tb_peminjaman')->where('id_pinjam', $id_pinjam)->update(['status' => '2']);
                DB::table('tb_peminjaman')->where('id_pinjam', $id_pinjam)->update(['username_verifpinjam' => $username_pinjam]);
                return response()->json([
                    'errorRes' => 0,
                    'message' => 'Berhasil verifikasi peminjaman'
                ], 200);
            } else if ($status == '3') {
                DB::table('tb_peminjaman')->where('id_pinjam', $id_pinjam)->update(['status' => '0']);
                DB::table('tb_peminjaman')->where('id_pinjam', $id_pinjam)->update(['username_verifkembali' => $username_pinjam]);
                return response()->json([
                    'errorRes' => 0,
                    'message' => 'Berhasil verifikasi pengembalian'
                ], 200);
            } else {
                return response()->json([
                    'errorRes' => 1,
                    'message' => 'Gagal'
                ], 200);
            }
        }
    }

    public function getDaftarBarang(Request $request)
    {
        $id_pinjam = request()->id_pinjam;


        $messages = [
            "id.required" => "ID kosong",
            "id.exists" => "ID salah",
        ];

        $validator = Validator::make($request->all(), [
            'id_pinjam' => 'required|string|exists:tb_peminjaman,id_pinjam',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errorRes' => 1,
                'messageRes' => $validator->messages()->all()[0],
            ], 200);
        } else {
            $daftarBarang = DB::table('tb_daftar_barang')->where('id_pinjam', $id_pinjam)->get();
            $dataBarang;

            $i = 0;
            foreach ($daftarBarang as $data) {
                $barang   = DB::table('tb_barang')->where('id_barang', $data->id_barang)->first();

                $barang = [
                    'id_barang' => $barang->id_barang,
                    'kategori' => DB::table('tb_kategori')->where('id_kategori', $barang->id_kategori)->value('nama_kategori'),
                    'tipe'     => DB::table('tb_tipe')->where('id_tipe', $barang->id_tipe)->value('nama_tipe'),
                    'merk' => DB::table('tb_merk')->where('id_merk', $barang->id_merk)->value('nama_merk'),
                    'kuantitas' => $data->kuantitas
                ];

                $dataBarang[$i] = $barang;
                $i++;
            }
            return response()->json(
                $dataBarang,
                200
            );
        }
    }

    public function peminjaman(Request $request)
    {
        $no = DB::table('tb_penomeran')->where('id', '1')->value('peminjaman');
        $no++;

        $peminjaman = [
            'id_pinjam' => 'PM' . $no,
            'nim' => $request->nim,
            'nama_kegiatan' => $request->nama_kegiatan,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'status' => '1'
        ];

        $id_barang = $request->id_barang;
        $kuantitas = $request->kuantitas;


        $messages = [
            "nim.required" => "NIM kosong",
            "nim.exists" => "NIM salah",
            "nim.numeric" => "Format NIM salah",
            "nama_kegiatan.required" => "Nama kegiatan harus diisi",
            "tgl_pinjam.required" => "Tanggal peminjaman harus diisi",
            "tgl_kembali.required" => "Tanggal pengembalian harus diisi"
        ];

        $validator = Validator::make($peminjaman, [
            'nim' => 'required|numeric|string|exists:tb_mahasiswa,nim|digits:7',
            'nama_kegiatan' => 'required',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errorRes' => 1,
                'message' => $validator->messages()->all()[0]
            ]);
        } else {
            $create = Peminjaman::create($peminjaman);
            DB::table('tb_penomeran')->where('id', 1)->update(['peminjaman' => $no]);
            for ($i = 0; $i < sizeof($id_barang); $i++) {
                $dataBarang = [
                    'id_pinjam' => 'PM' . $no,
                    'id_barang' => $id_barang[$i],
                    'kuantitas' => $kuantitas[$i]
                ];
                DaftarBarang::create($dataBarang);
            }
            if ($create) {
                return response()->json([
                    'errorRes' => 0,
                    'message' => 'Berhasil'
                ]);
            } else {
                return response()->json([
                    'errorRes' => 1,
                    'message' => 'gagal'
                ]);
            }
        }
    }
}
