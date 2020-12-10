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
        return $this->hasMany('App\Model\Pengembalian', 'kondisi_id', 'kondisi_id');
    }

    // Many to Many
    public function penyewaan_kondisi()
    {
            return $this->belongsToMany('App\Model\Penyewaan','pengembalian','kondisi_id','sewa_no');
    }

    public function alat_kondisi()
    {
        return $this->belongsToMany('App\Model\Alat','pengembalian','kondisi_id','alat_kode');
    }

    public function scopeSearch($query,$val){
        return $query
        ->where('kondisi_keterangan','like','%' .$val. '%')
        ->Orwhere('kondisi_dendarusak','like','%' .$val. '%');
    }
}
