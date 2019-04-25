<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Barang;
use App\Http\Controllers\Controller;

class BarangAPIController extends Controller
{
    public function index()
    {
        return Barang::all();
    }
}
