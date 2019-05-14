<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use DB;
use App\Teknisi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TeknisiAPIController extends Controller
{
    public function doLogin(Request $request)
    {
        $auth = auth()->guard('teknisi');

        $messages = [
            "username.required" => "Username Kosong",
            "username.exists" => "Username Salah",
            "username.regex" => "Format Username Salah [ Terdiri dari (a-z), (A-Z) dan (0-9) | exp. Username123 ]",
            "username.alpha_dash" => "Format Username Salah [ Terdiri dari (a-z), (A-Z) dan (0-9) | exp. Username123 ]",
            "password.required" => "Password Kosong",
            "password.regex" => "Format Password Salah [ Terdiri dari (a-z), (A-Z) dan (0-9) | exp. Password123 ]"
        ];

        $credentials = [
            'username'    => $request->username,
            'password' => $request->password,
        ];

        $validator = Validator::make($request->all(), [
            'username'   => 'required|max:15|alpha_dash|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/|exists:tb_teknisi,username',
            'password' => 'required|string|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
        ], $messages);


        if ($validator->fails()) {
            return response()->json([
                'errorRes'   => 1,
                'message' => $validator->messages()->all()[0],
            ], 200);
        } else {
            if ($auth->attempt($credentials)) {
                $nama_teknisi = DB::table('tb_teknisi')->where('username', $request->username)->value('nama_teknisi');
                return response()->json([
                    'errorRes'   => 0,
                    'message' => 'Login Success',
                    'username'   => $request->username,
                    'nama' => $nama_teknisi
                ], 200);
            } else {
                return response()->json([
                    'errorRes'   => 2,
                    'message' => 'Password Salah'
                ], 200);
            }
        }
    }
}
