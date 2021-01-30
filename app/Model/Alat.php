<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alat';
    protected $primaryKey = 'alat_kode';
    protected $fillable = [
        'alat_kode' , 'alat_jenis' , 'alat_merk' , 'alat_tipe' , 'alat_total' , 'kondisi_terbaru'
    ];

    public $incrementing = false;

    // Koneksi field Foreign
    public function jenis_alat() {
        return $this->belongsTo('App\Model\JenisAlat', 'alat_jenis', 'jenis_alat_id');
    }
    public function merk() {
        return $this->belongsTo('App\Model\Merk', 'alat_merk', 'merk_id');
    }

    // Koneksi PrimaryKey Alat di ForeignKey Tabel Lain :
    public function gambar_alat() {
        return $this->hasMany('App\Model\GambarAlat', 'gambar_kodealat', 'alat_kode');
    }

    public function detail_sewa() {
        return $this->hasMany('App\Model\DetailSewa', 'detail_sewa_alat_kode', 'alat_kode');
    }
    public function pengembalian() {
        return $this->hasMany('App\Model\Pengembalian', 'alat_kode', 'alat_kode');
    }

    //Many to many
    public function alat_sewa()
    {
        return $this->belongsToMany('App\Model\Penyewaan','detail_sewa','detail_sewa_alat_kode','detail_sewa_nosewa');
    }
    public function alat_kembali()
    {
        return $this->belongsToMany('App\Model\Penyewaan','pengembalian','alat_kode','sewa_no');
    }

    public function alat_kondisi()
    {
        return $this->belongsToMany('App\Model\KondisiAlat','pengembalian','alat_kode','total_kerusakan');
    }


    public function scopeSearch($query,$val){
        return $query
        ->where('alat_kode','like','%' .$val. '%')
        ->Orwhere('alat_total','like','%' .$val. '%')
        ->Orwhere('kondisi_terbaru','like','%' .$val. '%')
        ->Orwhere('alat_tipe','like','%' .$val. '%')
        ->orWhereHas('jenis_alat',function ($query) use($val){
            $query->where('jenis_alat_nama', 'like','%' .$val. '%');
        })
        ->orWhereHas('merk',function ($query) use($val){
            $query->where('merk_nama', 'like','%' .$val. '%');
        });

    }
}
