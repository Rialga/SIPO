<?php

namespace App\Http\Livewire\Admin;

use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;

class DetailPembayaran extends Component
{

    public $dataSewa;

    public $totalHari ,$grandTotal;
    public $harga = [];

    // Show Detail
    public function mount($invoice){

        $id = str_replace("-","/",$invoice);

        $this->dataSewa = Penyewaan::find($id);

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
        return view('livewire.admin.konfirmasiPembayaran.pembayaranDetail');
    }



    // Status change
    public function accept($id){
        $accept = Penyewaan::where('sewa_no' , $id)->first();
        $accept->sewa_status = 3;
        $accept->update();
        $this->emit('notifBayar');

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Pembayaran Disetujui',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right',
            'showConfirmButton' => false
        ]);

        return redirect('/list-sewa');
    }

    // status Change
    public function refuse($id){
        $accept = Penyewaan::where('sewa_no' , $id)->first();
        $accept->sewa_status = 7;
        $accept->update();

        $this->emit('notifTolak');
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Penolakan Berhasil',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right',
            'showConfirmButton' => false
        ]);
        return redirect('/list-sewa');

    }

}
