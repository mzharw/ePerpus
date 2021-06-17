<?php

use Illuminate\Support\Facades\Route;

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
    return view('master');
});

Route::get('/', 'App\Http\Controllers\AuthController@showFormLogin')->name('login');
Route::get('login', 'App\Http\Controllers\AuthController@showFormLogin')->name('login');
Route::post('login', 'App\Http\Controllers\AuthController@login');

// Nav

Route::get('penerbit','App\Http\Controllers\HomeController@penerbit');
Route::get('pengarang','App\Http\Controllers\HomeController@pengarang');
Route::get('pinjam','App\Http\Controllers\HomeController@pinjam');
Route::get('kembali','App\Http\Controllers\HomeController@kembali');

// Buku
Route::prefix('buku')->group(function(){
    Route::get('/','App\Http\Controllers\HomeController@buku');
    Route::get('/e/{idBuku}','App\Http\Controllers\BukuController@index')->name('edit');
    Route::post('/e/{idBuku}','App\Http\Controllers\BukuController@edit');
    Route::post('/a','App\Http\Controllers\BukuController@add');
    Route::get('/d/{idBuku}','App\Http\Controllers\BukuController@delete')->name('delete');
    
});

// Anggota
Route::prefix('anggota')->group(function(){
    Route::get('/','App\Http\Controllers\HomeController@anggota');
    Route::get('/e/{idAnggota}','App\Http\Controllers\AnggotaController@index');
    Route::post('/e/{idAnggota}','App\Http\Controllers\AnggotaController@edit');
    Route::post('/a','App\Http\Controllers\AnggotaController@add')->name('add');
    Route::get('/d/{idAnggota}','App\Http\Controllers\AnggotaController@delete');
});

// Pengarang
Route::prefix('pengarang')->group(function(){
    Route::get('/','App\Http\Controllers\HomeController@pengarang');
    Route::get('/e/{idPengarang}','App\Http\Controllers\PengarangController@index');
    Route::post('/e/{idPengarang}','App\Http\Controllers\PengarangController@edit');
    Route::post('/a','App\Http\Controllers\PengarangController@add')->name('add');
    Route::get('/d/{idPengarang}','App\Http\Controllers\PengarangController@delete');
});



Route::group(['middleware' => 'auth'], function () {

    Route::get('dashboard', 'App\Http\Controllers\HomeController@index',function(){
        return view('layouts.app');
    })->name('dashboard');
    Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

});