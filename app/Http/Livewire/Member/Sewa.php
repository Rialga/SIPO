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
    public $denda = [];

    public $counter = 0;

    public $status = 'all';

    public function mount(){
        $this->dataSewa = Penyewaan::where('sewa_user',auth()->id())->orderBy('updated_at','DESC')->orderBy('created_at', 'DESC')->get();

        foreach($this->dataSewa as $item){

            $estimasi = Carbon::parse( $item->sewa_tglsewa)->diffInDays( $item->sewa_tglkembali);


            foreach($item->detail_sewa as $data){

                if($item->sewa_status == 6){
                    foreach($item->pengembalian->where('alat_kode',$data->alat->alat_kode) as $val){
                            $denda_rusak[$item->sewa_no][]=  $val->biaya_denda * $val->total_kerusakan;
                    }

                    if($item->sewa_tglkembali > $val->pengembalian_waktu){
                        $denda_telat[$item->sewa_no] = 0;
                    }
                    else{
                        $denda_telat[$item->sewa_no] = Carbon::parse($item->sewa_tglkembali)->diffInDays($val->pengembalian_waktu);
                    }

                }

                if($estimasi == 1){
                    $harga =  $data->harga_sewa1  * $data->total_alat;
                }
                elseif($estimasi == 2){
                    $harga =  $data->harga_sewa2  * $data->total_alat;
                }
                elseif($estimasi == 3){
                    $harga =  $data->harga_sewa3  * $data->total_alat;
                }
                else{
                    $lama = $estimasi - 3;
                    $harga =  (($data->harga_sewa1 * $lama) + $data->harga_sewa3)  * $data->total_alat;
                }

                $harga1[$item->sewa_no][] = $data->harga_sewa1  * $data->total_alat;
                $totalAlat[$item->sewa_no][] = $harga;
            }

            if($item->sewa_status == 6){
                $this->denda[$item->sewa_no] = array_sum($denda_rusak[$item->sewa_no]) + (array_sum($harga1) * $denda_telat[$item->sewa_no] );
            }

            $this->totalAll[] = array_sum($totalAlat[$item->sewa_no]);
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
                $harga =  $data->harga_sewa  * $data->total_alat;
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
