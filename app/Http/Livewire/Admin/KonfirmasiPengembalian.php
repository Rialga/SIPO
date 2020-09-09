<?php

namespace App\Http\Livewire\Admin;

use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;

class KonfirmasiPengembalian extends Component
{

    public $totalHari, $totalAlat , $totalSewa;

    public $dataSewa;

    public $detailPage = false;

    public $sortBy = 'sewa_no';
    public $sortDiraction = 'asc';
    public $showPage = 10;
    public $search='';

    public function render()
    {
        $data = Penyewaan::where('sewa_status',5)->orderBy($this->sortBy, $this->sortDiraction)
        ->paginate($this->showPage);
        return view('livewire.admin.konfirmasiPengembalian.konfirmasi-pengembalian',['data'=>$data]);
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

        foreach($this->dataSewa->detail_sewa as $item){

            $harga[] = $item->detail_sewa_total * $item->alat->jenis_alat->jenis_alat_harga;

        }

        $this->totalAlat = array_sum($harga);

        $this->totalHari = Carbon::parse( $this->dataSewa->sewa_tglsewa)->diffInDays( $this->dataSewa->sewa_tglkembali );

        $this->totalSewa = $this->totalHari * $this->totalAlat;
        
        $this->detailPage = true;

    }


    public function clearForm(){


        $this->dataSewa = null;
        $this->totalAlat = null;
        $this->totalSewa = null;
        $this->totalHari = null;

        $this->detailPage = false;


        $this->sortBy = 'sewa_no';
        $this->sortDiraction = 'asc';
        $this->showPage = 10;
        $this->search='';

    }

}
