<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function showDataPeminjaman(){
        return view("dataPeminjaman");
    }
}
