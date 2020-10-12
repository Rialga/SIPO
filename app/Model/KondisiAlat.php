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

    // Many to Many
    public function penyewaan_kondisi()
    {
            return $this->belongsToMany('App\Model\Penyewaan','pengembalian','pengembalian_kondisi','pengembalian_nosewa');
    }

    public function alat_kondisi()
    {
        return $this->belongsToMany('App\Model\Alat','pengembalian','pengembalian_kondisi','pengembalian_kodealat');
    }

    public function scopeSearch($query,$val){
        return $query
        ->where('kondisi_keterangan','like','%' .$val. '%')
        ->Orwhere('kondisi_dendarusak','like','%' .$val. '%');
    }
}
