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

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('petugas', 'PetugasController');
Route::resource('anggota', 'AnggotaController');
Route::resource('buku', 'BukuController');
Route::resource('rak', 'RakController');
Route::resource('peminjaman', 'PeminjamanController');
Route::resource('pengembalian', 'PengembalianController');