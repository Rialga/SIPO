<?php

namespace App\Http\Livewire\Layouts;


use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Header extends Component
{

    public $cartTotal = 0;
    public $dataAlat = [];


    protected $listeners = [
        'cartAdded' => 'updateCart',
        'alatRemoved' => 'updateCart'
    ];



    public function mount(){

        if (Auth::guest()) {

        }
        else{
            $this->cartTotal = \Cart::session( auth()->id())->getTotalQuantity();
        }

    }

    public function logout(){

        $cart = \Cart::session( auth()->id())->getContent();

        foreach ($cart as $key => $item){
            \Cart::session(auth()->id())->remove($key);
        }

        Auth::logout();
        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.layouts.header');
    }

    public function updateCart(){

        $this->cartTotal = \Cart::session( auth()->id())->getTotalQuantity();
        // $this->dataAlat = \Cart::session( auth()->id())->getContent();
    }

}
