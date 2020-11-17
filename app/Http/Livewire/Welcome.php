<?php

namespace App\Http\Livewire;


use App\Model\Alat;
use App\Model\JenisAlat;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Welcome extends Component
{


    public $header = 'Perlengkapan Outdoor';
    public $dataJenis;
    public $button = [];
    public $search = '';
    public $filter = '';

    public function mount(){
        $this->dataJenis = JenisAlat::all();

    }

    public function render()
    {
        $dataAlat= Alat::search($this->search)
            ->search($this->filter)
            ->get();



            if(!Auth::guest()){
                foreach($dataAlat as $item) {

                    if(\Cart::session( auth()->id())->get($item->alat_kode) == null){
                        $this->button[$item->alat_kode] = 'true';
                    }
                    else{
                        if(\Cart::session( auth()->id())->get($item->alat_kode)->quantity == $item->alat_total){
                            $this->button[$item->alat_kode] = 'disabled';
                        }
                    }
                }

            }

        return view('livewire.welcome',['dataAlat'=>$dataAlat]);
    }


    public function filter($id){

       if($id == null){
            $this->header = 'Perlengkapan Outdoor';
       }
       else{
            $this->header = $id;
       }

       $this->filter = $id;
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
            $this->button[$id] = 'disabled';
        }

        $this->emit('cartAdded');

    }
}
