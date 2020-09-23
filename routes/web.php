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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/pelanggan/home', 'HomeController@indexP')->name('homeP');
Route::get('/supplier/home', 'HomeController@indexS')->name('homeS');
Route::get('/admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('admin');
Route::get('/error', 'HomeController@error');

Route::post('/barang/store','BarangController@store');
Route::get('/barang/hapus/{id}','BarangController@destroy');
Route::get('/barang/edit/{id}','BarangController@edit');
Route::post('/barang/update','BarangController@update');

Route::post('/pelanggan/store','PelangganController@store');
Route::get('/pelanggan/hapus/{id}','PelangganController@destroy');
Route::get('/pelanggan/edit/{id}','PelangganController@edit');
Route::post('/pelanggan/update','PelangganController@update');

Route::post('/supplier/store','SupplierController@store');
Route::get('/supplier/hapus/{id}','SupplierController@destroy');
Route::get('/supplier/edit/{id}','SupplierController@edit');
Route::post('/supplier/update','SupplierController@update');

Route::post('/user/store','UserController@store');
Route::get('/user/hapus/{id}','UserController@destroy');
Route::get('/user/edit/{id}','UserController@edit');
Route::post('/user/update','UserController@update');

Route::get('/pembelian','PembelianController@index')->middleware('supplier');
Route::post('/pembelian/store','PembelianController@store');

Route::post('/session/store','SessionController@store');
Route::get('/session/hapus/{id}','SessionController@destroy');

Route::get('/penjualan','PenjualanController@index')->middleware('pelanggan');
Route::post('/penjualan/store','PenjualanController@store');

Route::post('/sessionJ/store','SessionController@storeJ');
Route::get('/sessionJ/hapus/{id}','SessionController@destroyJ');

Route::get('/laporan','LaporanController@index');
Route::get('/laporan/cari','LaporanController@cari');
