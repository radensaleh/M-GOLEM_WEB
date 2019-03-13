<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLogin(){
        return view('login');
    }

    public function doLogin(Request $request){
        $auth = auth()->guard('teknisi');

        $credentials = [
          'email'    => $request->email,
          'password' => $request->password,
        ];

        $validator = Validator::make($request->all(), [
          'email'   => 'required|max:255|email',
          'password'=> 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ]);

        if ($validator->fails()) {
            return response()->json([
              'error'   => 1,
              'message' => $validator->messages(),
            ], 200);
        }else{
            if($auth->attempt($credentials)){
              return response()->json([
                  'error'   => 0,
                  'message' => 'Login Success',
                  'email'   => $request->email
              ], 200);
            }else{
              return response()->json([
                  'error'   => 2,
                  'message' => 'Wrong email or Password'
              ], 200);
            }
        }
    }
}
