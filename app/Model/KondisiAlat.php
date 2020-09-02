<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KondisiAlat extends Model
{
    protected $table = 'kondisi_alat';
    protected $primaryKey = 'kondisi_id';
    protected $fillable = [
        'kondisi_keterangan' , 'kondisi_dendarusak'
    ];

    // Koneksi PrimaryKey KondisiAlat di ForeignKey Tabel Lain :
    public function pengembalian() {
        return $this->hasMany('App\Model\Pengembalian', 'pengembalian_kondisi', 'kondisi_id');
    }

    public function scopeSearch($query,$val){
        return $query
        ->where('kondisi_keterangan','like','%' .$val. '%')
        ->Orwhere('kondisi_dendarusak','like','%' .$val. '%');
    }
}
