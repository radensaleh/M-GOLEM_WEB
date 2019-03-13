<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', 'LoginController@showLogin')->name('login');
Route::get('/dashboard', 'DashboardController@showDashboard')->name('dashboard');
Route::get('/dataMahasiswa', 'MahasiswaController@showDataMhs')->name('dataMhs');
Route::get('/dataPeminjaman', 'PeminjamanController@showDataPeminjaman')->name('dataPinjam');
Route::get('/dataPengembalian', 'PengembalianController@showDataPengembalian')->name('dataKembali');

Route::post('/doLogin','LoginController@doLogin')->name('doLogin');
