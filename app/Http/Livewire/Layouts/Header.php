<?php

namespace App\Http\Livewire\Layouts;

use App\Facades\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Header extends Component
{

    public $cartTotal = 0;

    protected $listeners = [
        'cartAdded' => 'updateCart',
        'alatRemoved' => 'updateCart'
    ];

    public $dataAlat;

    public function mount(){
        $this->dataAlat =  Cart::get()['dataAlat'];
        $this->cartTotal = count($this->dataAlat);
    }

    public function logout(){

        Auth::logout();
        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.layouts.header');
    }

    public function updateCart(){
        $this->dataAlat =  Cart::get()['dataAlat'];
        $this->cartTotal = count($this->dataAlat);
    }

}
