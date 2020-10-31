<?php

namespace App\Http\Livewire\Member;

use App\Http\Livewire\Admin\DetailPengembalian;
use App\Model\Pengembalian;
use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;

class DetailSewa extends Component
{

    public $totalHari , $subTotal, $grandTotal;
    public $dataSewa;
    public $waktuKembali;
    public $kondisi=[];
    public $totalDenda=[];
    public $detailKembali = false;


    public function mount($invoice){

        $id = str_replace("-","/",$invoice);
        $this->dataSewa = Penyewaan::where('sewa_no',$id)->first();

        $this->totalHari = Carbon::parse( $this->dataSewa->sewa_tglsewa )->diffInDays( $this->dataSewa->sewa_tglkembali );


        if($this->dataSewa->sewa_status == 6){
            foreach($this->dataSewa->detail_sewa as $key => $item){
                $this->kondisi [$item->alat->alat_kode] = Pengembalian::where('pengembalian_nosewa' , $id)->where('pengembalian_kodealat',$item->alat->alat_kode)->get();
                $harga[] = $item->detail_sewa_total * $item->alat->jenis_alat->jenis_alat_harga;

                foreach ($this->kondisi[$item->alat->alat_kode] as $iddenda => $data) {
                    $denda[$item->alat->alat_kode][$iddenda] =  $data->kondisi_alat->kondisi_dendarusak * $data->pengembalian_totalrusak;
                    // $tes[$item->alat->alat_kode][$iddenda] =  $data->kondisi_alat->kondisi_dendarusak ;
                }

                $this->totalDenda [$item->alat->alat_kode] = array_sum($denda[$item->alat->alat_kode]);
                $this->waktuKembali = $data->pengembalian_waktu;
                $this->detailKembali = true;
            }
        }
        else{
            foreach($this->dataSewa->detail_sewa as $key => $item){
                $harga[] = $item->detail_sewa_total * $item->alat->jenis_alat->jenis_alat_harga;
            }
        }



        $this->subTotal = array_sum($harga);
        $this->grandTotal = $this->subTotal * $this->totalHari;


    }


    public function render()
    {
        return view('livewire.member.sewa.detail-sewa');
    }
}
