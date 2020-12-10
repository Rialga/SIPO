<?php

namespace App\Http\Livewire\Admin;


use App\Model\Alat;
use App\Model\DetailSewa;
use App\Model\Pengembalian;
use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;
use Symfony\Component\Console\Input\Input;

class DetailListsewa extends Component
{

    public  $fullPrice , $totalHari, $tglPinjam , $tglKembali, $noSewa , $idlink;
    public $editConfirm ,$deleteConfirm;

    public $alat = [];
    public $stok = [];
    public $stokNow = [];
    public $alatNow = [];
    public $harga = [];
    public $harga1 = [];
    public $dataSewa , $dataAlat;

    public $kondisi = [];

    public $hargaTotal = 0;

    public function mount($invoice){
        $this->idlink = $invoice;

        $this->noSewa = str_replace("-","/",$invoice);

        return $this->kalkulasi();

    }


    public function kalkulasi(){
        $this->dataSewa = Penyewaan::find($this->noSewa);
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

            $this->harga1 []= $item->harga_sewa1 * $item->total_alat;
            $hargaXqtt[] = $this->harga[$item->detail_sewa_alat_kode] * $item->total_alat;


        }

        $this->fullPrice = array_sum($hargaXqtt);
    }


    public function render()
    {

        return view('livewire.admin.listSewa.sewaDetail');
    }

    public function updateStatus(){
        $status = Penyewaan::where('sewa_no' , $this->noSewa)->first();

        if($status->sewa_status == 3){


            foreach($status->detail_sewa as $item){

                $updateStok = Alat::where('alat_kode',$item->alat->alat_kode)->first();
                $stokNow = $updateStok->alat_total - $item->total_alat;

                $updateStok->alat_total = $stokNow  ;
                $updateStok->update();
            }

            $status->sewa_status = 4;
            $status->update();

            return $this->kalkulasi();
        }

        elseif($status->sewa_status == 4){
            $status->sewa_status = 5;
            $status->update();

            return redirect('detailpengembalian/'.$this->idlink);
        }
        else{
            dd('WTF');
        }

    }



    public function clearForm(){

        $this->validate([]);
        $this->alat = [];
        $this->stok = [];
        $this->stokNow = [];
        $this->alatNow = [];
        $this->inputs = [];

        $this->editConfirm =null;
        $this->deleteConfirm =null;


        $this->editPage = false;

        return $this->kalkulasi();
    }
}
