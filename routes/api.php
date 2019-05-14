<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\TeknisiAPIController@doLogin');
Route::post('loginMhs', 'API\MahasiswaAPIController@login');
Route::post('ubahPassword', 'API\MahasiswaAPIController@ubahPassword');
Route::post('ubahPasswordTeknisi', 'API\TeknisiAPIController@ubahPassword');
Route::get('mahasiswa', 'API\MahasiswaAPIController@getMahasiswa');
Route::post('registrasi', 'API\MahasiswaAPIController@registrasi');
Route::get('barang', 'API\BarangAPIController@getBarang');
Route::get('kelas', 'API\KelasAPIController@getKelas');
Route::post('pinjamBarang', 'API\PeminjamanAPIController@peminjaman');
Route::get('getPeminjaman', 'API\PeminjamanAPIController@getPeminjaman');
Route::get('getPeminjamanMhs', 'API\PeminjamanAPIController@getPeminjamanMhs');
Route::get('verifikasi', 'API\PeminjamanAPIController@verifPeminjaman');
Route::get('pengembalianPinjam', 'API\PeminjamanAPIController@pengembalianPinjam');
Route::get('getDaftarBarang', 'API\PeminjamanAPIController@getDaftarBarang');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('details', 'API\UserController@details');
});
