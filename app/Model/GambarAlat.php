<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GambarAlat extends Model
{
    protected $table = 'gambar_alat';
    protected $primaryKey = 'gambar_id';
    protected $fillable = [
        'gambar_kodealat' , 'gambar_file'
    ];


    // Koneksi field Foreign
    public function alat() {
        return $this->belongsTo('App\Model\Alat', 'gambar_kodealat', 'alat_kode');
    }
}
