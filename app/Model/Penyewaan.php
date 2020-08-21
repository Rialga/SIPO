<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    protected $table = 'penyewaan';
    protected $primaryKey = 'sewa_no';
    protected $fillable = [
        'sewa_no' , 'sewa_jenis' , 'sewa_status' , 'sewa_user' , 'sewa_tglsewa' , 'sewa_tglbayar' , 'sewa_tglkembali' , 'sewa_buktitf' , 'sewa_offnama' , 'sewa_offphone'
    ];

    public $incrementing = false;

    // Koneksi field Foreign
    public function user() {
        return $this->belongsTo('App\Model\User', 'sewa_user', 'user_id');
    }
    public function jenis_sewa() {
        return $this->belongsTo('App\Model\JenisSewa', 'sewa_jenis', 'jenis_id');
    }
    public function status_sewa() {
        return $this->belongsTo('App\Model\StatusSewa', 'sewa_status', 'status_id');
    }


    //Many to many
    public function alat_detail_sewa()
    {
        return $this->belongsToMany('App\Model\Alat','detail_sewa','detail_laporan_nosewa','alat_kode');
    }

    public function alat_pengembalian()
    {
        return $this->belongsToMany('App\Model\Alat','pengembalian','pengembalian_nosewa','alat_kode');
    }
}
