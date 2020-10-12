<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalian';
    protected $fillable = [
        'pengembalian_nosewa' , 'pengembalian_kodealat' , 'pengembalian_kondisi' , 'pengembalian_totalrusak' , 'pengembalian_waktu'
    ];



    // Koneksi field Foreign
    public function alat() {
        return $this->belongsTo('App\Model\Alat', 'pengembalian_kodealat', 'alat_kode');
    }
    public function penyewaan() {
        return $this->belongsTo('App\Model\Penyewaan', 'pengembalian_nosewa', 'sewa_no');
    }
    public function kondisi_alat() {
        return $this->belongsTo('App\Model\KondisiAlat', 'pengembalian_kondisi', 'kondisi_id');
    }
}
