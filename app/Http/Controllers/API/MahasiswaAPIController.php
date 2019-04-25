<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use DB;
use App\Mahasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MahasiswaAPIController extends Controller
{
    public function login(Request $request)
    {
        $auth = auth()->guard('mahasiswa');

        $messages = [
            "nim.required" => "NIM kosong",
            "nim.exists" => "NIM salah",
            "nim.numeric" => "Format NIM salah",
            "password.required" => "Password kosong"
        ];

        $credentials = [
            'nim'    => $request->nim,
            'password' => $request->password,
        ];

        $validator = Validator::make($request->all(), [
            'nim' => 'required|numeric|string|exists:tb_mahasiswa,nim',
            'password' => 'required|string',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errorRes' => 1,
                'messageRes' => $validator->messages(),
            ], 200);
        } else {
            if ($auth->attempt($credentials)) {
                $nama = DB::table('tb_mahasiswa')->where('nim', $request->nim)->value('nama_mhs');
                $id_kelas = DB::table('tb_mahasiswa')->where('nim', $request->nim)->value('id_kelas');
                return response()->json([
                    'errorRes' => 0,
                    'message' => 'Login berhasil',
                    'nama' => $nama,
                    'kelas' => $id_kelas,
                ]);
            } else {
                return response()->json([
                    'errorRes'   => 2,
                    'message' => 'Password salah'
                ], 200);
            }
        }
    }

    public function registrasi(Request $request)
    { }
}
