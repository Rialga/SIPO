<?php

namespace App\Http\Livewire\Member;

use App\Model\Penyewaan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notifikasi extends Component
{

    public $dataRefuse ,$dataKembali;

    public function mount(){

        $this->dataRefuse = Penyewaan::where('sewa_user', Auth::User()->user_id)->where('sewa_status',7)->get();
        $this->dataKembali = Penyewaan::where('sewa_user', Auth::User()->user_id)->where('sewa_status',5)->whereDate('sewa_tglkembali','<=',Carbon::now())->get();
        // dd($this->dataKembali = Penyewaan::where('sewa_user', Auth::User()->user_id)->where('sewa_status',5)->whereDate('sewa_tglkembali','>',Carbon::now())->get());

    }

    public function render()
    {
        return view('livewire.member.notifikasi.notifikasi');
    }

    public function page($inv,$stat){

        $invoice = str_replace("/","-",$inv);

        return redirect('detail/'.$invoice);

    }
}
