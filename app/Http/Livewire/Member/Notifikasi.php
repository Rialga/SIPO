<?php

namespace App\Http\Livewire\Member;

use App\Model\Penyewaan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notifikasi extends Component
{

    public $dataRefuse;

    public function mount(){

        $this->dataRefuse = Penyewaan::where('sewa_user', Auth::User()->user_id)->where('sewa_status',7)->get();

    }

    public function render()
    {
        return view('livewire.member.notifikasi.notifikasi');
    }

    public function page($inv,$stat){

        $invoice = str_replace("/","-",$inv);

        if($stat == 7){
            return redirect('detail/'.$invoice);
        }
        else{

        }
    }
}
