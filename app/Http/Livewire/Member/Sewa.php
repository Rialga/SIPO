<?php

namespace App\Http\Livewire\Member;

use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;

class Sewa extends Component
{
    public $all = 'active' , $checkout , $done , $refuse, $canceled;

    public $dataSewa;

    public $totalAll = [];

    public $counter = 0;

    public $status = 'all';

    public function mount(){
        $this->dataSewa = Penyewaan::where('sewa_user',auth()->id())->orderBy('updated_at','DESC')->orderBy('created_at', 'DESC')->get();

        foreach($this->dataSewa as $item){

            foreach($item->detail_sewa as $data){
                $harga =  $data->alat->jenis_alat->jenis_alat_harga  * $data->detail_sewa_total;
                $totalAlat[] = $harga;
            }

            $estimasi = Carbon::parse( $item->sewa_tglsewa)->diffInDays( $item->sewa_tglkembali);

            $total = $estimasi * array_sum($totalAlat);

            $this->totalAll[] = $total;
        }


    }

    public function render()
    {
        return view('livewire.member.sewa.sewa');
    }


    public function changeStat($id){

        $this->status = $id;

        if($id == 'all'){
            $this->all = 'active';
            $this->checkout = null;
            $this->done = null;
            $this->refuse = null;
            $this->canceled = null;
            $this->dataSewa = Penyewaan::where('sewa_user',auth()->id())->orderBy('updated_at','DESC')->orderBy('created_at', 'DESC')->get();
        }
        elseif($id == 'checkout'){
            $this->all = null;
            $this->checkout = 'active';
            $this->done = null;
            $this->refuse = null;
            $this->canceled = null;
            $this->dataSewa = Penyewaan::where([['sewa_user',auth()->id()],['sewa_status',1]])->orderBy('created_at', 'DESC')->get();
        }
        elseif($id == 'done'){
            $this->all = null;
            $this->checkout = null;
            $this->done = 'active';
            $this->refuse = null;
            $this->canceled = null;
            $this->dataSewa = Penyewaan::where([['sewa_user',auth()->id()],['sewa_status',6]])->orderBy('created_at', 'DESC')->get();
        }
        elseif($id == 'refuse'){
            $this->all = null;
            $this->checkout = null;
            $this->done = null;
            $this->refuse = 'active';
            $this->canceled = null;
            $this->dataSewa = Penyewaan::where([['sewa_user',auth()->id()],['sewa_status',7]])->orderBy('created_at', 'DESC')->get();
        }
        else{
            $this->all = null;
            $this->checkout = null;
            $this->done = null;
            $this->refuse = null;
            $this->canceled = 'active';
            $this->dataSewa = Penyewaan::where([['sewa_user',auth()->id()],['sewa_status',0]])->orderBy('created_at', 'DESC')->get();
        }



        foreach($this->dataSewa as $item){

            foreach($item->detail_sewa as $data){
                $harga =  $data->alat->jenis_alat->jenis_alat_harga  * $data->detail_sewa_total;
                $totalAlat[] = $harga;
            }

            $estimasi = Carbon::parse( $item->sewa_tglsewa)->diffInDays( $item->sewa_tglkembali);
            $total = $estimasi * array_sum($totalAlat);
            $this->totalAll[] = $total;
        }
    }


    public function showPage($id , $stat){

        $invoice = str_replace("/","-",$id);

        if($stat == 1 or $stat == 7){
            return redirect('pembayaran/'.$invoice);
        }
        else{
            return redirect('detail/'.$invoice);
        }

    }
}
