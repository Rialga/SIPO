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


// Guest
Route::livewire('/','welcome');

Route::livewire('/produk/{kode}','detail-produk');

Route::livewire('/login','login');

Route::livewire('/register','register');


//ADMIN

Route::livewire('/profile-data','admin.petugas-profile');

Route::livewire('/dashboard','admin.dashboard');

Route::livewire('/petugas','admin.petugas');
Route::livewire('/member','admin.member');

Route::livewire('/alat','admin.alat');
Route::livewire('/jenis','admin.jenis');
Route::livewire('/merk','admin.merk');

Route::livewire('/kelola-denda','admin.kelola-denda');

Route::livewire('/list-sewa','admin.list-sewa');
Route::livewire('/detailsewa/{invoice}','admin.detail-listsewa');

Route::livewire('/konfirmasi-pembayaran','admin.konfirmasi-pembayaran');
Route::livewire('/detailpembayaran/{invoice}','admin.detail-pembayaran');

Route::livewire('/pengembalian','admin.konfirmasi-pengembalian');
Route::livewire('/detailpengembalian/{invoice}','admin.detail-pengembalian');

Route::livewire('/report-penyewaan','admin.report-penyewaan');
Route::livewire('/export/{tgl}/{search}','admin.export-report');

// MEMBER
Route::livewire('/profile','member.profile');
Route::livewire('/cart','member.cart');

Route::livewire('/sewa','member.sewa');
Route::livewire('/pembayaran/{invoice}', 'member.pembayaran');
Route::livewire('/detail/{invoice}', 'member.detail-sewa');

Route::livewire('/notifikasi','member.notifikasi');



