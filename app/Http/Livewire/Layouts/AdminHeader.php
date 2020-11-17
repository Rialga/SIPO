<?php

namespace App\Http\Livewire\Layouts;

use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminHeader extends Component
{
    public $dataNotif;
    public $sendWa = true;

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

    // public function sendNotif(){
    //     $today = Carbon::now();
    //     $datakembali = Penyewaan::where('sewa_status',5)->where('sewa_tglkembali',$today->addDays(1))->get();

    //         if($today->format('H:i') == '15:10'){
    //             foreach($datakembali as $item){
    //             }
    //             dd('yes');
    //         }
    //         else{
    //             dd('not');
    //         }
    // }
}
