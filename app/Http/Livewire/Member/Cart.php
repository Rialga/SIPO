<?php

namespace App\Http\Livewire\Member;

use App\Facades\Cart as FacadesCart;
use Livewire\Component;

class Cart extends Component
{

    public $total = 1;
    public $tglPinjam , $tglKembali;
    public $dataAlat;
    public $cartTotal = 0;

    public function mount(){

        $this->dataAlat =  FacadesCart::get()['dataAlat'];
        $this->cartTotal = count($this->dataAlat);
    }

    public function render()
    {
        return view('livewire.member.cart.cart');
    }


    public function remove($id){

        FacadesCart::remove($id);
        $this->cart = FacadesCart::get();
        $this->emit('alatRemoved ');

    }
}
