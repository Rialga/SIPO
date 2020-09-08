<?php

namespace App\Http\Livewire\Admin;

use App\Model\Penyewaan;
use Livewire\Component;

class KonfirmasiPembayaran extends Component
{

    public $detailPage = false;

    public $dataSewa ;

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
    }

}
