<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalian';
    protected $fillable = [
        'sewa_no' , 'alat_kode' , 'kondisi_id' , 'total_kerusakan' , 'pengembalian_waktu' , 'biaya_denda'
    ];



    // Koneksi field Foreign
    public function alat() {
        return $this->belongsTo('App\Model\Alat', 'sewa_no', 'alat_kode');
    }
    public function penyewaan() {
        return $this->belongsTo('App\Model\Penyewaan', 'sewa_no', 'sewa_no');
    }
    public function kondisi_alat() {
        return $this->belongsTo('App\Model\KondisiAlat', 'kondisi_id', 'kondisi_id');
    }
}
