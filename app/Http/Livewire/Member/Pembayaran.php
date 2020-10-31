<?php

namespace App\Http\Livewire\Member;


use App\Model\Penyewaan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Pembayaran extends Component
{

    use WithFileUploads;

    public $totalHari , $subTotal, $grandTotal , $buktiTf;
    public $dataSewa;


    public function mount($invoice){

        $id = str_replace("-","/",$invoice);
        $this->dataSewa = Penyewaan::where('sewa_no',$id)->first();

        $this->totalHari = Carbon::parse( $this->dataSewa->sewa_tglsewa )->diffInDays( $this->dataSewa->sewa_tglkembali );

        foreach($this->dataSewa->detail_sewa as $item){

            $harga[] = $item->detail_sewa_total * $item->alat->jenis_alat->jenis_alat_harga;

        }

        $this->subTotal = array_sum($harga);
        $this->grandTotal = $this->subTotal * $this->totalHari;
    }

    public function render()
    {
        return view('livewire.member.pembayaran.pembayaran');
    }


    public function bayar(){

        if($pic = $this->buktiTf){
            $this->validate([
                'buktiTf' => 'required |max:30000',
            ]);
            $name =  Auth::user()->user_nick.'_'.Carbon::now()->format('d-m-y').'.jpg';

            // dd($name);
            $update = $this->dataSewa;
            $update->sewa_buktitf = $name;
            $update->sewa_status = 2;
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
