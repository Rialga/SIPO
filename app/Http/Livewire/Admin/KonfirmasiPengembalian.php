<?php

namespace App\Http\Livewire\Admin;

use App\Model\KondisiAlat;
use App\Model\Pengembalian;
use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;

class KonfirmasiPengembalian extends Component
{

    public $dataSewa;

    public $sortBy = 'sewa_no';
    public $sortDiraction = 'asc';
    public $showPage = 10;
    public $search='';

    // return view
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



    // Show Detail Sewa
    public function showDetailPage($id){

        $invoice = str_replace("/","-",$id);

        return redirect('detailpengembalian/'.$invoice);


    }




}
