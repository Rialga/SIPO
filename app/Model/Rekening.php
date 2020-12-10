<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    protected $table = 'rekening';
    protected $primaryKey = 'rekening_no';
    protected $fillable = [
        'rekening_no' , 'rekening_bank' , 'rekening_an'
    ];


    public function scopeSearch($query,$val){
        return $query
        ->where('rekening_no','like','%' .$val. '%')
        ->Orwhere('rekening_bank','like','%' .$val. '%')
        ->Orwhere('rekening_an','like','%' .$val. '%');
    }
}
