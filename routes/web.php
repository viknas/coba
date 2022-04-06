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
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::group(['prefix' => 'kelola-keuangan'], function () {
        Route::resource('pengingat', 'PengingatController');
        Route::resource('pendapatan', 'PendapatanController');
    });
    Route::resource('rekomendasi', 'RekomendasiController');
    Route::get('web-profile', 'WebProfileController@index')->name('web-profile.index');
    Route::put('web-profile', 'WebProfileController@update')->name('web-profile.update');
    Route::get('ulasan', 'UlasanController@index')->name('ulasan.index');
    Route::delete('ulasan/{id}', 'UlasanController@destroy')->name('ulasan.destroy');
    Route::get('riwayat', 'RiwayatController@index')->name('riwayat.index');
    Route::get('riwayat-get', 'RiwayatController@show')->name('riwayat.show');
    Route::get('pelanggan', 'PelangganController@index')->name('pelanggan.index');
});

require __DIR__ . '/auth.php';
