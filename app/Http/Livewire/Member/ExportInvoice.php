<?php

namespace App\Http\Livewire\Member;

use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;


class ExportInvoice extends Component
{

    public $invoice ;

    public $dataSewa;
    public $totalHari;
    public $grandTotal;
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
        return view('livewire.member.export.export-invoice');
    }
}
