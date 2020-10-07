<?php

use App\Http\Livewire\Member\Pembayaran;
use App\Model\User;
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


Route::get('/insert', function () {


    $nama  = 'rialga Febri Algani';
    $firstName = explode(' ',trim($nama));
    $username = $firstName[0];


    $i = substr(md5(time()), 0, 3);
    while(User::where('user_nick',$username)->exists()) {
        $i++;
        $username = $firstName[0] .'_'. $i;
    }
    $this->attributes['username'] = $username;

    dd($username);
});



// Guest
Route::livewire('/','welcome');

Route::livewire('/produk/{kode}','detail-produk');


Route::livewire('/login','login');


//ADMIN

Route::livewire('/dashboard','admin.dashboard');

Route::livewire('/petugas','admin.petugas');
Route::livewire('/member','admin.member');

Route::livewire('/alat','admin.alat');
Route::livewire('/jenis','admin.jenis');
Route::livewire('/merk','admin.merk');

Route::livewire('/kelola-denda','admin.kelola-denda');

Route::livewire('/list-sewa','admin.list-sewa');
Route::livewire('/konfirmasi-pembayaran','admin.konfirmasi-pembayaran');
Route::livewire('/pengembalian','admin.konfirmasi-pengembalian');

Route::livewire('/report-penyewaan','admin.report-penyewaan');

// MEMBER
Route::livewire('/profile','member.profile');
Route::livewire('/cart','member.cart');

Route::livewire('/sewa','member.sewa');
Route::livewire('/pembayaran/{invoice}', 'member.pembayaran');
Route::livewire('/detail/{invoice}', 'member.detail-sewa');


Route::livewire('/notifikasi','member.notifikasi');



