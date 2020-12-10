<?php

namespace App\Http\Livewire\Layouts;

use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminHeader extends Component
{
    public $dataNotif;
    public $dataReminder;
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
        $this->dataReminder = Penyewaan::where('sewa_status',5)->whereDate('sewa_tglkembali',Carbon::now())->get();


    }

    public function render()
    {
        return view('livewire.layouts.admin-header');
    }

    public function page($id,$jenis){

        $invoice = str_replace("/","-",$id);

        if($jenis == 1){
            return redirect('detailpembayaran/'.$invoice);
        }
        else{
            return redirect('detailpengembalian/'.$invoice);
        }


    }


    public function updateNotif(){
        $today = Carbon::now();
        $this->dataNotif = Penyewaan::where('sewa_status',2)->get();
        $this->dataReminder = Penyewaan::where('sewa_status',5)->whereDate('sewa_tglkembali','<=',Carbon::now())->get();

        if($today->format('H:i') == '19:30'){
            return $this->sendNotif();
        }

    }

    public function sendNotif(){
        $today = Carbon::now();
        $datakembali = Penyewaan::where('sewa_status',5)->whereDate('sewa_tglkembali',$today->addDays(1))->get();
        foreach($datakembali as $item){

            $nohape = $item->user->user_phone;
            if($nohape['0']=='0') {

                $nohape['0']='2';
                $nohape = '6'.$nohape;
            }

            $my_apikey = "KTEF9YI2NIU5XI7FV5RI";
            $destination = $nohape;
            $message = "REMINDER!! Hy Guys, Jangan Lupa untuk menjaga kondisi alat dan mengembalikannya Besok";
            $api_url = "http://panel.rapiwha.com/send_message.php";
            $api_url .= "?apikey=". urlencode ($my_apikey);
            $api_url .= "&number=". urlencode ($destination);
            $api_url .= "&text=". urlencode ($message);

            $my_result_object = json_decode(file_get_contents($api_url, false));
            $result = [$my_result_object->success , $my_result_object->description , $my_result_object->description];
            return json_encode($result);
        }

    }
}
