<?php

namespace App\Http\Livewire\Member;

use App\Model\Alat;
use App\Model\Penyewaan;
use App\Model\Rekening;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Pembayaran extends Component
{

    use WithFileUploads;

    public $totalHari , $grandTotal , $buktiTf , $rek;
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
        $dataRek = Rekening::where('rekening_an' ,'not like' , '%Di Lokasi%' )->get();
        $bank = Rekening::where('rekening_no' ,$this->rek )->first();
        return view('livewire.member.pembayaran.pembayaran',['dataRek'=>$dataRek , 'bank'=>$bank]);
    }


    public function bayar(){

        if($pic = $this->buktiTf){
            $this->validate([
                'buktiTf' => 'required |max:1024|image',
                'rek' => 'required',
            ]);
            $name =  Auth::user()->user_nick.'_'.Carbon::now()->format('d-m-y').Str::random(3).'.jpg';


            $update = $this->dataSewa;
            if($update->sewa_buktitf != 'belum bayar'){
                Storage::disk('public')->delete('buktiTf/'.$update->sewa_buktitf);
            }
            $update->sewa_buktitf = $name;
            $update->sewa_status = 2;
            $update->sewa_rek = $this->rek;
            $update->sewa_tglbayar = Carbon::now();
            $update->update();

            $pic->storePubliclyAs('buktiTf/',$name);

            $this->emit('notifBayar');
        }
        return redirect('/sewa');
    }

    public function batal($id){

        $accept = Penyewaan::where('sewa_no' , $id)->first();
        $accept->sewa_status = 0;
        $accept->update();

        foreach ($accept->detail_sewa as $data){
            $alat = Alat::where('alat_kode' , $data->alat->alat_kode)->first();
            $alat->alat_total = $alat->alat_total + $data->total_alat;
            $alat->update();
        }

        $this->emit('notifTolak');
        $this->emit('notifBayar');

        return redirect('/sewa');
    }


}
