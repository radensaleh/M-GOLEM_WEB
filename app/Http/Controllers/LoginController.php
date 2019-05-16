<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
  public function showLogin(Request $request)
  {
    if ($request->session()->exists('usernameTeknisi')) {
      return redirect()->route('dashboard');
    } else if ($request->session()->exists('usernameAdmin')) {
      return redirect()->route('dashboardAdmin');
    } else {
      return view('login');
    }
  }

  public function showLoginAdmin(Request $request)
  {
    if ($request->session()->exists('usernameAdmin')) {
      return redirect()->route('dashboardAdmin');
    } else if ($request->session()->exists('usernameTeknisi')) {
      return redirect()->route('dashboard');
    } else {
      return view('adminWeb.login');
    }
  }

  //do Login Teknisi
  public function doLogin(Request $request)
  {
    $auth = auth()->guard('teknisi');

    $credentials = [
      'username'    => $request->username,
      'password' => $request->password,
    ];

    $validator = Validator::make($request->all(), [
      'username'   => 'required|max:15|alpha_dash|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
      'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error'   => 1,
        'message' => $validator->messages(),
      ], 200);
    } else {
      if ($auth->attempt($credentials)) {
        $request->session()->put('usernameTeknisi', $request->username);
        return response()->json([
          'error'   => 0,
          'message' => 'Login Success',
          'username'   => $request->username
        ], 200);
      } else {
        return response()->json([
          'error'   => 2,
          'message' => 'Wrong Username or Password'
        ], 200);
      }
    }
  }

  //do Login Admin
  public function doLoginAdmin(Request $request)
  {
    $auth = auth()->guard('admin');

    $credentials = [
      'username'    => $request->username,
      'password' => $request->password,
    ];

    $validator = Validator::make($request->all(), [
      'username'   => 'required|max:15|alpha_dash|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
      'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error'   => 1,
        'message' => $validator->messages(),
      ], 200);
    } else {
      if ($auth->attempt($credentials)) {
        $request->session()->put('usernameAdmin', $request->username);
        return response()->json([
          'error'   => 0,
          'message' => 'Login Success',
          'username'   => $request->username
        ], 200);
      } else {
        return response()->json([
          'error'   => 2,
          'message' => 'Wrong Username or Password'
        ], 200);
      }
    }
  }
}
