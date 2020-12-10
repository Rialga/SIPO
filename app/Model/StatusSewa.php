<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StatusSewa extends Model
{
    protected $table = 'status_sewa';
    protected $primaryKey = 'status_id';
    protected $fillable = [
        'status_detail'
    ];
    public $timestamps = false;

    // Koneksi PrimaryKey StatusSewa di ForeignKey Tabel Lain :
    public function penyewaan() {
        return $this->hasMany('App\Model\Penyewaan', 'sewa_status', 'status_id');
    }
}
