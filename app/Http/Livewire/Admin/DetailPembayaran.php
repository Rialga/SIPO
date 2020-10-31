<?php

namespace App\Http\Livewire\Admin;

use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;

class DetailPembayaran extends Component
{

    public $dataSewa;

    public $totalHari , $subTotal, $grandTotal;

    // Show Detail
    public function mount($invoice){

        $id = str_replace("-","/",$invoice);

        $this->dataSewa = Penyewaan::find($id);

        $this->totalHari = Carbon::parse( $this->dataSewa->sewa_tglsewa )->diffInDays( $this->dataSewa->sewa_tglkembali );


        foreach($this->dataSewa->detail_sewa as $item){

            $harga[] = $item->detail_sewa_total * $item->alat->jenis_alat->jenis_alat_harga;

        }

        $this->subTotal = array_sum($harga);
        $this->grandTotal = $this->subTotal * $this->totalHari;

        $this->detailPage = true;

    }

    public function render()
    {
        return view('livewire.admin.konfirmasiPembayaran.pembayaranDetail');
    }



    // Status change
    public function accept($id){
        $accept = Penyewaan::where('sewa_no' , $id)->first();
        $accept->sewa_status = 3;
        $accept->update();
        $this->emit('notifBayar');

        return redirect('/list-sewa');
    }

    // status Change
    public function refuse($id){
        $accept = Penyewaan::where('sewa_no' , $id)->first();
        $accept->sewa_status = 7;
        $accept->update();

        $this->emit('notifTolak');
        return redirect('/list-sewa');

    }

}
