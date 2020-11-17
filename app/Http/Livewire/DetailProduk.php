<?php

namespace App\Http\Livewire;

use App\Model\Alat;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailProduk extends Component
{

    public $dataAlat , $idDiv , $idPic , $button;

    public function mount($kode){

        $this->dataAlat = Alat::where('alat_kode',$kode)->first();


        if(!Auth::guest()){

            if(\Cart::session( auth()->id())->get($kode) == null){
                $this->button = 'true';
            }
            else{
                if(\Cart::session( auth()->id())->get($kode)->quantity == $this->dataAlat->alat_total){
                    $this->button = 'disabled';
                }
            }


        }

        $this->idDiv = 0;
        $this->idPic = 0;

    }


    public function render()
    {
        return view('livewire.detail-produk');
    }

    public function addToCart($id){

        $Alat = Alat::where('alat_kode',$id)->first();

        if (\Cart::session( auth()->id())->get($id) == null){

            \Cart::session( auth()->id())->add(array(
                'id' => $Alat->alat_kode,
                'name' => $Alat->jenis_alat->jenis_alat_nama,
                'price' => $Alat->jenis_alat->jenis_alat_harga,
                'quantity' => 1,
                'attributes' => array(
                    'merk' => $Alat->merk->merk_nama,
                    'type' => $Alat->alat_tipe,
                    'pic' => $Alat->gambar_alat[0]->gambar_file,
                ),
                'associatedModel' => $Alat
            ));

        }

        else{

            \Cart::session( auth()->id())->update($id,[
                'quantity' => +1,
            ]);
        }


        if(\Cart::session( auth()->id())->get($id)->quantity == $Alat->alat_total){
            $this->button = 'disabled';
        }

        $this->emit('cartAdded');

    }
}
