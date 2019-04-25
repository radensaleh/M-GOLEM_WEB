<?php

namespace App\Http\Controllers;

use DB;
use App\Teknisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeknisiController extends Controller
{
  // --------------------- ADMIN ---------------------- //
  public function showDtTeknisiAdmin(Request $request)
  {
    $username = $request->session()->get('usernameAdmin');
    $nama_admin = DB::table('tb_admin')->where('username', $username)->value('nama');

    $teknisi = Teknisi::all();
    return view('adminWeb.dataTeknisi', compact('nama_admin', 'teknisi'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'username'   => 'required|max:15|alpha_dash|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
      'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => 2,
        'message' => $validator->messages(),
      ], 200);
    } else {
      $checkIfExist = Teknisi::where('username', $request->username)->get();
      if (count($checkIfExist) != 0) {
        return response()->json([
          'error' => 1,
          'message' => 'Username Already Exist'
        ], 200);
      }

      $create = Teknisi::create($request->all());
      if ($create) {
        return response()->json([
          'error' => 0,
          'message' => 'Success Add Data'
        ], 200);
      }
    }
  }

  public function update(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'username'   => 'required|max:15|alpha_dash|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
      'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => 2,
        'message' => $validator->messages(),
      ], 200);
    } else {
      $data = Teknisi::findOrFail($request->username);
      $data->update($request->all());

      if ($data) {
        return response()->json([
          'error' => 0,
          'message' => 'Success Edit Data'
        ], 200);
      }
    }
  }

  public function destroy(Request $request)
  {
    $data = Teknisi::findOrFail($request->username);

    try {
      $data->delete();

      if ($data) {
        return response()->json([
          'error' => 0,
          'message' => 'Success Delete Data'
        ], 200);
      }
    } catch (\Exception $e) {
      return response()->json([
        'error' => 1,
        'message' => 'Failed Delete Data'
      ], 200);
    }
  }
}
