<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetailSewa extends Model
{
    protected $table = 'detail_sewa';
    protected $fillable = [
        'detail_sewa_alat_kode' , 'detail_sewa_nosewa' , 'detail_sewa_total '
    ];

    // Koneksi field Foreign
    public function alat() {
        return $this->belongsTo('App\Model\Alat', 'detail_sewa_alat_kode', 'alat_kode');
    }
    public function penyewaan() {
        return $this->belongsTo('App\Model\Penyewaan', 'detail_sewa_nosewa', 'sewa_no');
    }

}
