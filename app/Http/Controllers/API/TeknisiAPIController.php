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
            "username.regex" => "Format Username Salah",
            "username.alpha_dash" => "Format Username Salah",
            "password.required" => "Password Kosong",
            "password.regex" => "Format Password Salah"
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
