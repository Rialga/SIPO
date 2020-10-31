<?php

namespace App\Http\Livewire\Layouts;

use App\Model\Penyewaan;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminHeader extends Component
{
    public $dataNotif;

    protected $listeners = [
        'notifBayar' => 'updateNotif',
    ];


    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function mount(){

        $this->dataNotif = Penyewaan::where('sewa_status',2)->get();

    }

    public function render()
    {
        return view('livewire.layouts.admin-header');
    }

    public function page($id){

        $invoice = str_replace("/","-",$id);
        return redirect('detailpembayaran/'.$invoice);

    }


    public function updateNotif(){

        $this->dataNotif = Penyewaan::where('sewa_status',2)->get();

    }
}
