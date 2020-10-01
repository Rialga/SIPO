<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use App\Model\Alat;
use Livewire\Component;

class Welcome extends Component
{


    public $dataAlat;

    public function render()
    {
        $this->dataAlat = Alat::all();
        return view('livewire.welcome');
    }

    public function addToCart($id){

        Cart::add(Alat::where('alat_kode',$id)->first());
        $this->emit('cartAdded');

    }
}
