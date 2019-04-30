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
            "nim.required" => "NIM Kosong",
            "nim.exists" => "NIM Salah",
            "nim.numeric" => "Format NIM Salah",
            "password.required" => "Password Kosong",
            "password.regex" => "Format Password Salah"
        ];

        $credentials = [
            'nim'    => $request->nim,
            'password' => $request->password,
        ];

        $validator = Validator::make($request->all(), [
            'nim' => 'required|numeric|string|exists:tb_mahasiswa,nim|digits:7',
            'password' => 'required|string|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errorRes' => 1,
                'message' => $validator->messages()->all()[0],
            ], 200);
        } else {
            if ($auth->attempt($credentials)) {
                $nama = DB::table('tb_mahasiswa')->where('nim', $request->nim)->value('nama_mhs');
                $id_kelas = DB::table('tb_mahasiswa')->where('nim', $request->nim)->value('id_kelas');
                return response()->json([
                    'errorRes' => 0,
                    'message' => 'Login Berhasil',
                    'nama' => $nama,
                    'kelas' => $id_kelas,
                ]);
            } else {
                return response()->json([
                    'errorRes'   => 2,
                    'message' => 'Password Salah'
                ], 200);
            }
        }
    }

    public function registrasi(Request $request)
    {
        $credentials = [
            'nama_mhs' => $request->nama,
            'nim'    => $request->nim,
            'password' => $request->password,
            'id_kelas' => $request->kelas,
        ];

        $messages = [
            "nama_mhs.required" => "Nama tidak boleh kosong",
            "nama_mhs.alpha_dash" => "Format nama salah",
            "nim.required" => "NIM tidak boleh kosong",
            "nim.unique" => "NIM sudah terdaftar",
            "nim.numeric" => "Format NIM salah",
            "nim.digits" => "Jumlah digit NIM harus 7",
            "password.required" => "Password tidak boleh kosong"
        ];

        $validator = Validator::make($request->all(), [
            'nama_mhs' => 'required|string|alpha_dash|alpha',
            'nim' => 'required|string|unique:tb_mahasiswa|numeric|digits:7',
            'password' => 'required|string',
            'id_kelas' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errorRes' => 1,
                'message' => $validator->messages()->all()[0],
            ], 200);
        } else {
            $create = Mahasiswa::create($request->all());
            if ($create) {
                return response()->json([
                    'errorRes' => 0,
                    'message' => 'Registrasi Berhasil'
                ], 200);
            }
        }
    }
}
