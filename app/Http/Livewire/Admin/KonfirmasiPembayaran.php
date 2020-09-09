<?php

namespace App\Http\Livewire\Admin;

use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;

class KonfirmasiPembayaran extends Component
{

    public $detailPage = false;

    public $dataSewa;

    public $totalHari , $subTotal, $grandTotal;

    public $sortBy = 'sewa_no';
    public $sortDiraction = 'asc';
    public $showPage = 10;
    public $search='';

    public function render()
    {
        $data = Penyewaan::where('sewa_status' , 2)->orderBy($this->sortBy, $this->sortDiraction)
        ->paginate($this->showPage);
        return view('livewire.admin.konfirmasiPembayaran.konfirmasi-pembayaran',['data'=>$data]);
    }

    // sorting
    public function sortBy($field){
        if ($this->sortDiraction == 'asc' ){
            $this->sortDiraction = 'desc';
        }
        else{
            $this->sortDiraction = 'asc';
        }

        return $this->sortBy = $field;
    }

    public function showDetailPage($id){

        $this->dataSewa = Penyewaan::find($id);

        $this->totalHari = Carbon::parse( $this->dataSewa->sewa_tglsewa )->diffInDays( $this->dataSewa->sewa_tglkembali );


        foreach($this->dataSewa->detail_sewa as $item){

            $harga[] = $item->detail_sewa_total * $item->alat->jenis_alat->jenis_alat_harga;

        }

        $this->subTotal = array_sum($harga);
        $this->grandTotal = $this->subTotal * $this->totalHari;

        $this->detailPage = true;

    }

    public function accept($id){
        $accept = Penyewaan::where('sewa_no' , $id)->first();
        $accept->sewa_status = 3;
        $accept->update();
        $this->detailPage = false;

    }

    public function refuse($id){
        $accept = Penyewaan::where('sewa_no' , $id)->first();
        $accept->sewa_status = 7;
        $accept->update();
        $this->detailPage = false;
    }

    public function clearForm(){

        $this->detailPage = false;

        $this->sortBy = 'sewa_no';
        $this->sortDiraction = 'asc';
        $this->showPage = 10;
        $this->search='';

    }

}
