<?php

namespace App\Http\Livewire\Member;


use App\Model\Pengembalian;
use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;

class DetailSewa extends Component
{

    public $totalHari , $grandTotal;
    public $dataSewa;
    public $waktuKembali;
    public $kondisi=[];
    public $totalDenda=[];
    public $detailKembali = false;
    public $harga = [];
    public $harga1 = [];


    public function mount($invoice){

        $id = str_replace("-","/",$invoice);
        $this->dataSewa = Penyewaan::where('sewa_no',$id)->first();

        $this->totalHari = Carbon::parse( $this->dataSewa->sewa_tglsewa )->diffInDays( $this->dataSewa->sewa_tglkembali );


        if($this->dataSewa->sewa_status == 6){
            foreach($this->dataSewa->detail_sewa as $key => $item){
                $this->kondisi [$item->alat->alat_kode] = Pengembalian::where('sewa_no' , $id)->where('alat_kode',$item->alat->alat_kode)->get();

                foreach ($this->kondisi[$item->alat->alat_kode] as $iddenda => $data) {
                    $denda[$item->alat->alat_kode][$iddenda] =  $data->biaya_denda * $data->total_kerusakan;
                    // $tes[$item->alat->alat_kode][$iddenda] =  $data->kondisi_alat->kondisi_dendarusak ;
                }

                $this->totalDenda [$item->alat->alat_kode] = array_sum($denda[$item->alat->alat_kode]);
                $this->waktuKembali = $data->pengembalian_waktu;

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
                $this->harga1[] = $item->harga_sewa1 * $item->total_alat;
                $hargaXqtt[] = $this->harga[$item->detail_sewa_alat_kode] * $item->total_alat;

            }

            $this->detailKembali = true;
        }
        else{
            foreach($this->dataSewa->detail_sewa as  $item){

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

        }


        $this->grandTotal = array_sum($hargaXqtt);


    }


    public function render()
    {
        return view('livewire.member.sewa.detail-sewa');
    }


    public function export(){

        $invoice = str_replace("/","-",$this->dataSewa->sewa_no);

        return redirect('/export-invoice/'.$invoice);


    }
}
