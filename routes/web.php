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

//Resource
Route::resource('data-teknisi', 'TeknisiController');
Route::resource('data-tipe', 'TipeController');
Route::resource('data-merk', 'MerkController');
Route::resource('data-kategori', 'KategoriController');
Route::resource('data-barang','BarangController');
Route::resource('data-mhs', 'MahasiswaController');
Route::resource('data-kelas', 'KelasController');


//Teknisi
Route::get('/', 'LoginController@showLogin')->name('login');
Route::get('/dashboard', 'DashboardController@showDashboard')->name('dashboard');
Route::get('/dataMahasiswa', 'MahasiswaController@showDataMhs')->name('dataMhs');
Route::get('/dataPeminjaman', 'PeminjamanController@showDataPeminjaman')->name('dataPinjam');
Route::get('/dataPengembalian', 'PengembalianController@showDataPengembalian')->name('dataKembali');
Route::post('/doLogin','LoginController@doLogin')->name('doLogin');
Route::get('/logout', 'DashboardController@logout')->name('logout');
Route::get('/dataBarang', 'BarangController@showDataBarang')->name('dataBarang');

//Admin
Route::get('/admin/page/login', 'LoginController@showLoginAdmin')->name('loginAdmin');
Route::post('/doLoginAdmin','LoginController@doLoginAdmin')->name('doLoginAdmin');
Route::get('/admin/page/dashboard','DashboardController@showDashboardAdmin')->name('dashboardAdmin');
Route::get('/admin/page/logout', 'DashboardController@logoutAdmin')->name('logoutAdmin');
Route::get('/admin/page/dtMahasiswa', 'MahasiswaController@showDtMhsAdmin')->name('dataMhsAdmin');
Route::get('/admin/page/dtTeknisi','TeknisiController@showDtTeknisiAdmin')->name('dataTeknisiAdmin');
Route::get('/admin/page/dtKelas','KelasController@showDtKelasAdmin')->name('dataKelasAdmin');
Route::get('/admin/page/dtBarang', 'BarangController@showDtBarangAdmin')->name('dataBarangAdmin');
Route::get('/admin/page/dtMerk', 'MerkController@showDtMerkAdmin')->name('dataMerkAdmin');
Route::get('/admin/page/dtTipe', 'TipeController@showDtTipeAdmin')->name('dataTipeAdmin');
Route::get('/admin/page/dtkategori', 'KategoriController@showDtKategoriAdmin')->name('dataKategoriAdmin');
Route::get('/admin/page/dtKelas', 'KelasController@showDtKelasAdmin')->name('dataKelasAdmin');

Route::get('/admin/page/dtBarang/pdf/{id_barang}','BarangController@pngQrcode')->name('downloadPng');
Route::get('/admin/page/dtBarang/allPdf', 'BarangController@allQrCode')->name('allQrCode');
Route::get('/admin/page/dtBarang/pdfDtBarang', 'BarangController@allDtBarang')->name('allDtBarang');
