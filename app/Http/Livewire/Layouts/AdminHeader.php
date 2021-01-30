<?php

namespace App\Http\Livewire\Layouts;

use App\Model\Alat;
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
        $this->dataReminder = Penyewaan::where('sewa_status',5)->whereDate('sewa_tglkembali', '<=' ,Carbon::now())->get();

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
        $this->dataReminder = Penyewaan::where('sewa_status',5)
                                ->whereDate('sewa_tglkembali','<=',Carbon::now())->get();

        // Jika Tanggal Sewa < Hari ini
        $delete = Penyewaan::where('sewa_status',1)->whereDate('sewa_tglsewa','<',Carbon::now())->get();

        if($delete->count() != 0){

            foreach($delete as $inv){
                foreach ($delete->detail_sewa as $data){
                    $alat = Alat::where('alat_kode' , $data->alat->alat_kode)->first();
                    $alat->alat_total = $alat->alat_total + $data->total_alat;
                    $alat->update();
                }

                $inv->delete();
            }

        }

        // 2021-01-20 22:20:55
        if($today->format('H:i') >= '20:12'){

            return $this->sendNotif();
        }

    }

    public function sendNotif(){

        // dd(Carbon::parse(1000-01-01)->format('Y-m-d'));
        $today= '';
        $today = Carbon::now()->addDays(1);
        $datakembali = Penyewaan::where('sewa_status',5)
                        ->where('updated_at','not like' , '%2000-02-02%')
                        ->whereDate('sewa_tglkembali',$today)->get();
        if($datakembali->count() != 0){
            // dd($datakembali->count());
            foreach($datakembali as $item){

                $item->updated_at = '2000-02-02';
                $item->update();


                $nohape = $item->user->user_phone;
                if($nohape['0']=='0') {

                    $nohape['0']='2';
                    $nohape = '6'.$nohape;
                }

                $my_apikey = "EB8Z9ZXEBJ16MBO50NGK";
                $destination = $nohape;
                $message = "REMINDER!! Hy Guys, Jangan Lupa untuk menjaga kondisi alat dan mengembalikannya Besok !";
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
}
