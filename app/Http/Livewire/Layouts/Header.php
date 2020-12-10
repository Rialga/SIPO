<?php

namespace App\Http\Livewire\Layouts;

use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Header extends Component
{

    public $cartTotal = 0;
    public $dataAlat = [];

    public $dataRefuse;
    public $dataNotif;


    protected $listeners = [
        'cartAdded' => 'updateCart',
        'alatRemoved' => 'updateCart',
        'notifTolak' => 'updateCart'
    ];



    public function mount(){

        if (!Auth::guest()) {
            $this->cartTotal = \Cart::session( auth()->id())->getTotalQuantity();
            $this->dataRefuse = Penyewaan::where('sewa_user', Auth::User()->user_id)->where('sewa_status',7)->get();
            $this->dataNotif = Penyewaan::where('sewa_user', Auth::User()->user_id)
                                ->where('sewa_status',5)
                                ->whereDate('sewa_tglkembali','<=',Carbon::now())
                                ->get();

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

    }

    public function updateNotif(){

        $this->dataRefuse = Penyewaan::where('sewa_user', Auth::User()->user_id)->where('sewa_status',7)->get();
        $this->dataNotif = Penyewaan::where('sewa_user', Auth::User()->user_id)->where('sewa_status',5)->whereDate('sewa_tglkembali','<=',Carbon::now())->get();


    }

    public function page($id){
        return redirect('notifikasi/');

    }

}
