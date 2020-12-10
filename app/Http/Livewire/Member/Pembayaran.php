<?php

namespace App\Http\Livewire\Member;


use App\Model\Penyewaan;
use App\Model\Rekening;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Pembayaran extends Component
{

    use WithFileUploads;

    public $totalHari , $grandTotal , $buktiTf;
    public $dataSewa;
    public $harga = [];


    public function mount($invoice){

        $id = str_replace("-","/",$invoice);
        $this->dataSewa = Penyewaan::where('sewa_no',$id)->first();

        $this->totalHari = Carbon::parse( $this->dataSewa->sewa_tglsewa )->diffInDays( $this->dataSewa->sewa_tglkembali );

        foreach($this->dataSewa->detail_sewa as $item){

            if($this->totalHari == 1){
                $this->harga[$item->detail_sewa_alat_kode] =  $item->harga_sewa1  ;
            }
            elseif($this->totalHari == 2){
                $this->harga[$item->detail_sewa_alat_kode] =  $item->harga_sewa2;
            }
            elseif($this->totalHari == 3){
                $this->harga[$item->detail_sewa_alat_kode] =  $item->harga_sewa3;
            }
            else{
                $lama = $this->totalHari - 3;
                $this->harga[$item->detail_sewa_alat_kode] =  ($item->harga_sewa1 * $lama) + $item->harga_sewa3;
            }

            $hargaXqtt[] = $this->harga[$item->detail_sewa_alat_kode] * $item->total_alat;

        }


        $this->grandTotal = array_sum($hargaXqtt);
    }

    public function render()
    {
        $dataRek = Rekening::all();
        return view('livewire.member.pembayaran.pembayaran',['dataRek'=>$dataRek]);
    }


    public function bayar(){

        if($pic = $this->buktiTf){
            $this->validate([
                'buktiTf' => 'required |max:1024|image',
            ]);
            $name =  Auth::user()->user_nick.'_'.Carbon::now()->format('d-m-y').'.jpg';

            // dd($name);
            $update = $this->dataSewa;
            $update->sewa_buktitf = $name;
            $update->sewa_status = 2;
            $update->sewa_tglbayar = Carbon::now();
            $update->update();

            $pic->storeAs('buktiTf',$name);

            $this->emit('notifBayar');
        }
        return redirect('/sewa');
    }

    public function batal($id){

        $accept = Penyewaan::where('sewa_no' , $id)->first();
        $accept->sewa_status = 0;
        $accept->update();

        $this->emit('notifTolak');
        $this->emit('notifBayar');

        return redirect('/sewa');
    }


}
