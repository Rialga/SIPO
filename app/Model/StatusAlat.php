<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StatusAlat extends Model
{
    protected $table = 'status_alat';
    protected $primaryKey = 'statusalat_id';
    protected $fillable = [
        'statusalat_keterangan'
    ];

    // Koneksi PrimaryKey StatusAlat di ForeignKey Tabel Lain :
    public function alat() {
        return $this->hasMany('App\Model\Alat', 'alat_status', 'statusalat_id');
    }
}
