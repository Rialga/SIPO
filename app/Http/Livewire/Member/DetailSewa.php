<?php

namespace App\Http\Livewire\Member;

use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;

class DetailSewa extends Component
{

    public $totalHari , $subTotal, $grandTotal;
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
        return view('livewire.member.sewa.detail-sewa');
    }
}
