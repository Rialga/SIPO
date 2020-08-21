<?php

namespace App\Model;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable {
    use  Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id', 'user_role', 'user_nama', 'user_mail', 'user_alamat', 'user_job','user_password',
    ];

        /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_password', 'remember_token',
    ];


    public $incrementing = false;

    private $have_role;

    // Koneksi field Foreign
    public function role() {
        return $this->belongsTo('App\Model\Role', 'user_role', 'role_id');
    }

    // Koneksi PrimaryKey User di ForeignKey Tabel Lain :
    public function penyewaan() {
        return $this->hasMany('App\Model\Penyewaan', 'sewa_user', 'user_nik');
    }

    public function getAuthPassword(){
        return $this->user_password;
    }


    // Pendeklarasian Role
    public function hasRole($roles)
    {
        $this->have_role = $this->getUserRole();

        if($this->have_role->role_name == ['Admin','Penyewa']) {
            return true;
        }
        if(is_array($roles)){
            foreach($roles as $need_role){
                if($this->cekUserRole($need_role)) {
                    return true;
                }
            }
        } else{
            return $this->cekUserRole($roles);
        }
        return false;
    }

    //Get User ROle
    private function getUserRole()
    {
        return $this->role()->getResults();
    }

    //Validasi Role User
    private function cekUserRole($role)
    {
        return (strtolower($role)==strtolower($this->have_role->role_name)) ? true : false;
    }


}
