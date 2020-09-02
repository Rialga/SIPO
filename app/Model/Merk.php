<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    protected $table = 'merk';
    protected $primaryKey = 'merk_id';
    protected $fillable = [
        'merk_nama'
    ];


    // Koneksi PrimaryKey Merk di ForeignKey Tabel Lain :
    public function gambar() {
        return $this->hasMany('App\Model\Alat', 'alat_merk', 'merk_id');
    }

    public function scopeSearch($query,$val){
        return $query
        ->where('merk_nama','like','%' .$val. '%');
    }
}
