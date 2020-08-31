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

Route::livewire('/','welcome');
Route::livewire('/login','login');



Route::livewire('/dashboard','admin.dashboard');

Route::livewire('/petugas','admin.petugas');
Route::livewire('/member','admin.member');

Route::livewire('/alat','admin.alat');
Route::livewire('/jenis','admin.jenis');
Route::livewire('/merk','admin.merk');

Route::livewire('/kelola-denda','admin.kelola-denda');

Route::livewire('/list-sewa','admin.list-sewa');
Route::livewire('/pengembalian','admin.konfirmasi-pengembalian');

Route::livewire('/report-penyewaan','admin.report-penyewaan');



