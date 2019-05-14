<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use DB;
use App\Mahasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
            "password.regex" => "Format Password Salah [ Terdiri dari (a-z), (A-Z) dan (0-9) | exp. Password123 ]"
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

    public function ubahPassword(Request $request)
    {
        $auth = auth()->guard('mahasiswa');
        $nim = $request->nim;
        $password = $request->password;
        $oldPassword = $request->oldPassword;

        $messages = [
            "nim.required" => "NIM kosong",
            "nim.exists" => "NIM salah",
            "nim.numeric" => "Format NIM salah",
            "password.required" => "Password baru tidak boleh kosong",
            "oldPassword.required" => "Password lama tidak boleh kosong",
            "password.regex" => "Format Password Baru Salah [ Terdiri dari (a-z), (A-Z) dan (0-9) | exp. Password123 ]"
        ];

        $validator = Validator::make($request->all(), [
            'nim' => 'required|numeric|string|exists:tb_mahasiswa,nim|digits:7',
            'oldPassword' => 'required|string|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
            'password' => 'required|string|different:oldPassword|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errorRes' => 1,
                'message' => $validator->messages()->all()[0],
            ], 200);
        } else {
            $passLama = Mahasiswa::where('nim', $nim)->value('password');
            if (Hash::check($passLama, $oldPassword)) {
                return response()->json([
                    'errorRes' => 0,
                    'message' => "Benar",
                ], 200);
            } else {
                return response()->json([
                    'errorRes' => 1,
                    'message' => "Password Lama Salah",
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
            "nama_mhs.required" => "Nama Tidak Boleh Kosong",
            "nama_mhs.alpha_dash" => "Format Nama Salah",
            "nim.required" => "NIM Tidak Boleh Kosong",
            "nim.unique" => "NIM Sudah Terdaftar",
            "nim.numeric" => "Format NIM Salah",
            "nim.digits" => "Jumlah Digit NIM Harus 7 Digit",
            "id_kelas.exists" => "Data Kelas Tidak Ada",
            "password.required" => "Password Tidak Boleh Kosong",
            "password.regex" => "Format Password Salah [ Terdiri dari (a-z), (A-Z) dan (0-9) | exp. Password123 ]"
        ];

        $validator = Validator::make($request->all(), [
            'nama_mhs' => 'required|string',
            // 'nama_mhs' => 'required|string|alpha_dash|alpha',
            'nim' => 'required|string|unique:tb_mahasiswa|numeric|digits:7',
            'password' => 'required|string|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
            'id_kelas' => 'required|exists:tb_kelas,id_kelas',
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

    public function getMahasiswa(Request $request)
    {

        $nim = request()->nim;

        $messages = [
            "nim.required" => "NIM tidak boleh kosong",
            "nim.unique" => "NIM sudah terdaftar",
            "nim.numeric" => "Format NIM salah",
            "nim.digits" => "Jumlah digit NIM harus 7",
        ];

        $validator = Validator::make($request->all(), [
            'nim' => 'required|string|exists:tb_mahasiswa,nim|numeric|digits:7',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errorRes' => 1,
                'message' => $validator->messages()->all()[0],
            ], 200);
        } else {
            $mahasiswa = Mahasiswa::where('nim', $nim)->first();
            $mahasiswa->id_kelas = DB::table('tb_kelas')->where('id_kelas', $mahasiswa->id_kelas)->value('nama_kelas');
            return response()->json($mahasiswa);
        }
    }
}
