<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use DB;
use App\Kelas;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class KelasAPIController extends Controller
{
    public function getKelas()
    {
        $kelas = Kelas::all();

        if ($kelas == null) {
            return response()->json([
                'result' => false,
                'message' => 'Data Kosong'
            ]);
        } else {
            return response()->json($kelas);
        }
    }
}
