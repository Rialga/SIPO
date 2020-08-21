<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'role_id';
    protected $fillable = [
        'role_nama'
    ];


    // Koneksi PrimaryKey Role di ForeignKey Tabel Lain :
    public function user() {
        return $this->hasMany('App\Model\User', 'user_role', 'role_id');
    }
}
