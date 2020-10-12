<?php

namespace App\Http\Livewire\Admin;

use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;

class KonfirmasiPembayaran extends Component
{



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


   // Status change
    public function accept($id){
        $accept = Penyewaan::where('sewa_no' , $id)->first();
        $accept->sewa_status = 3;
        $accept->update();
    }

    // status Change
    public function refuse($id){
        $accept = Penyewaan::where('sewa_no' , $id)->first();
        $accept->sewa_status = 7;
        $accept->update();
    }

    // Show Detail
    public function showDetailPage($id){

        $invoice = str_replace("/","-",$id);
        return redirect('detailpembayaran/'.$invoice);

    }
}
