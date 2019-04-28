<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;

class BarangAPIController extends Controller
{
    public function index()
    {
        return Barang::all();
    }
}
