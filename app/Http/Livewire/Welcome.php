<?php

namespace App\Http\Livewire;


use App\Model\Alat;
use App\Model\JenisAlat;
use App\Model\Penyewaan;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use PhpParser\Node\Stmt\Else_;

class Welcome extends Component
{


    public $header = 'Perlengkapan Outdoor';
    public $tglPinjam = '';
    public $tglKembali = '';
    public $dataJenis;
    public $button = [];
    public $search = '';
    public $filter = '';
    public $stokTerpakai=[];

    public $dataAlat;

    public $stokNow = [];
    public $alatMode = false;



    public function mount(){
        $this->dataJenis = JenisAlat::all();

        $this->dataAlat= Alat::search($this->search)
        ->search($this->filter)
        ->get();


        //Trigger disabeld buton
        if(!Auth::guest()){
            foreach($this->dataAlat as $item){

                if(\Cart::session( auth()->id())->get($item->alat_kode) != null){

                    $this->tglPinjam = \Cart::session( auth()->id())->get($item->alat_kode)->attributes->pinjam;
                    $this->tglKembali = \Cart::session( auth()->id())->get($item->alat_kode)->attributes->kembali;

                    break;
                }
            }
        }

        if($this->tglKembali == null OR $this->tglPinjam == null){

            $this->alatMode = false;
        }
        else{

            return $this->filtertotal();
        }

    }

    public function render()
    {
        // data alat
        $this->dataAlat= Alat::search($this->search)
            ->search($this->filter)
            ->get();



        return view('livewire.welcome',['dataAlat'=>$this->dataAlat]);
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


    public function filtertotal(){

        $this->validate([
            'tglPinjam'=> 'required',
            'tglKembali'=> 'required',
        ]);


        $this->stokTerpakai = [];


        // get data berdasarkan Tgl
        if($this->tglPinjam == $this->tglKembali){
            $sewa = Penyewaan::Where('sewa_status',  3)
            ->where(function($a){
                $a->whereDate('sewa_tglsewa', Carbon::parse($this->tglPinjam))
                  ->orWhere(function($p){
                        $p->whereDate('sewa_tglkembali', Carbon::parse($this->tglPinjam));
                    })
                  ->orWhere(function($d){
                      $d->where('sewa_tglsewa','<=' ,$this->tglPinjam )
                        ->where('sewa_tglkembali' , '>=' ,  $this->tglPinjam);
                    });

              })->get();

        }

        else{
            $sewa = Penyewaan::Where('sewa_status',  3)
            ->where(function($a){
                $a->whereBetween('sewa_tglsewa', [Carbon::parse($this->tglPinjam),Carbon::parse($this->tglKembali)])
                  ->OrwhereBetween('sewa_tglkembali', [Carbon::parse($this->tglPinjam),Carbon::parse($this->tglKembali)])
                  ->orWhere(function($p){
                    $p->where('sewa_tglsewa','<=' ,$this->tglPinjam )
                      ->where('sewa_tglkembali' , '>=' ,  $this->tglPinjam);
                  })
                  ->orWhere(function($k){
                    $k->where('sewa_tglsewa','<=' ,$this->tglKembali )
                      ->where('sewa_tglkembali' , '>=' ,  $this->tglKembali);
                  });

            })->get();

        }

        // save stok dalam array Stok terpakai []
        foreach($sewa as $item){

            $stokSewa = [];
            foreach ($item->detail_sewa as $datailData){

                $stokSewa [$datailData->detail_sewa_alat_kode] = $datailData->total_alat;

            }

            foreach($stokSewa as $key => $val){

                if(isset($this->stokTerpakai[$key])) {
                    $this->stokTerpakai[$key] = $this->stokTerpakai[$key] + $val;
                }
                else{
                    $this->stokTerpakai[$key] = $val;
                }
            }
        }



        //Trigger disabeld buton
        foreach($this->dataAlat as $item){
            $this->stokNow[$item->alat_kode] = $item->alat_total;

            if(isset($this->stokTerpakai[$item->alat_kode])){
                $this->stokNow[$item->alat_kode] = $this->stokNow[$item->alat_kode] - $this->stokTerpakai[$item->alat_kode];
            }


            if(!Auth::guest()){
                if(\Cart::session( auth()->id())->get($item->alat_kode) == null OR \Cart::session( auth()->id())->get($item->alat_kode)->quantity < $this->stokNow[$item->alat_kode]){
                    $this->button[$item->alat_kode] = 'true';
                }
                else{
                    //disabled button
                    if(\Cart::session( auth()->id())->get($item->alat_kode)->quantity == $this->stokNow[$item->alat_kode]){
                        $this->button[$item->alat_kode] = 'disabled';
                    }
                }

                //Ganti Tanggal
                \Cart::session( auth()->id())->update($item->alat_kode,[
                    'attributes' => array(
                        'merk' => $item->merk->merk_nama,
                        'type' => $item->alat_tipe,
                        'pic' => $item->gambar_alat[0]->gambar_file,
                        'pinjam'=> $this->tglPinjam,
                        'kembali'=> $this->tglKembali,
                    )
                ]);
            }
        }


        // dd($this->stokNow , $this->stokTerpakai);

        $this->alatMode = true;


    }

    public function addToCart($id){

        $Alat = Alat::where('alat_kode',$id)->first();

        if (\Cart::session( auth()->id())->get($id) == null){

            \Cart::session( auth()->id())->add(array(
                'id' => $Alat->alat_kode,
                'name' => $Alat->jenis_alat->jenis_alat_nama,
                'price' => $Alat->jenis_alat->jenis_alat_harga1,
                'quantity' => 1,
                'attributes' => array(
                    'merk' => $Alat->merk->merk_nama,
                    'type' => $Alat->alat_tipe,
                    'pic' => $Alat->gambar_alat[0]->gambar_file,
                    'harga2' =>$Alat->jenis_alat->jenis_alat_harga2,
                    'harga3' => $Alat->jenis_alat->jenis_alat_harga3,
                    'pinjam'=> $this->tglPinjam,
                    'kembali'=> $this->tglKembali,
                ),
                'associatedModel' => $Alat
            ));

        }
        else{

            \Cart::session( auth()->id())->update($id,[
                'quantity' => +1,
            ]);

        }

        if(\Cart::session( auth()->id())->get($id)->quantity == $this->stokNow[$id]){
            $this->button[$id] = 'disabled';
        }

        $this->emit('cartAdded');

    }


}
