<?php

namespace App\Helpers;

use App\Model\Alat;

class Cart
{

    public function __construct(){

        if($this->get() === null){

            $this->set($this->empty());

        }

    }

    public function add(Alat $alat){

        $cart = $this->get();

        array_push($cart['dataAlat'] , $alat);

        $this->set($cart);

    }

    public function remove($id){

        $cart= $this->get();

        array_splice($cart['dataAlat'],array_search($id, array_column($cart['dataAlat'], 'alat_kode')),1);

        $this->set($cart);
    }


    public function empty(){

        return [
            'dataAlat' => [],
        ];

    }

    public function get(){

        return session()->get('cart');
    }

    public function set($cart){

        session()->put('cart',$cart);
    }




}
