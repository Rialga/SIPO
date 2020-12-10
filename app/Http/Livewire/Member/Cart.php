<?php

namespace App\Http\Livewire\Member;


use App\Model\DetailSewa;
use App\Model\Alat;
use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;

class Cart extends Component
{

    public $tglPinjam , $tglKembali, $sumHarga , $estimasi, $sewaTujuan,$rowId ;
    public $stok = [];
    public $harga = [];
    public $stokTerpakai = [];
    public $stokNow = [];


    public function modal($id, $type){
        $this->rowId = $id;
        $this->dispatchBrowserEvent('mCart');

    }

    public function mount(){
        $this->stokTerpakai = [];
        $this->stokNow = [];
        $hargaXqtt = [];
        $this->harga = [];

        $data = \Cart::session( auth()->id())->getContent();
        foreach($data as $key => $item){
            $this->tglPinjam = $item->attributes->pinjam;
            $this->tglKembali = $item->attributes->kembali;


            if(Carbon::parse( $this->tglPinjam )->diffInDays( $this->tglKembali) == 0){
                $this->estimasi = 1;
            }
            else{
                $this->estimasi = Carbon::parse( $this->tglPinjam )->diffInDays( $this->tglKembali);
            }

            // dd($this->estimasi);

            if($this->estimasi == 1){
                $this->harga[$key] = $item->price ;
            }
            elseif($this->estimasi == 2){
                // dd($item->attributes->harga2);
                $this->harga[$key] = $item->attributes->harga2 ;
            }
            elseif($this->estimasi == 3){

                $this->harga[$key] = $item->attributes->harga3 ;
            }
            else{
                // dd($item->attributes->harga3);
                $lama = $this->estimasi - 3;
                $this->harga[$key] =  ($item->price * $lama) + $item->attributes->harga3 ;
            }

            $this->stok[$key] = $item->quantity;
            $hargaXqtt[] = $this->harga[$key] * $this->stok[$key] ;

        }


        $this->sumHarga = array_sum($hargaXqtt);


        if($this->tglKembali == '' OR $this->tglPinjam == ''){
            $sewa = '';
        }
        elseif($this->tglPinjam == $this->tglKembali){
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

        if($sewa != ''){
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
        }

        foreach(Alat::all() as $item){

            $this->stokNow[$item->alat_kode] = $item->alat_total;

            if(isset($this->stokTerpakai[$item->alat_kode])){
                $this->stokNow[$item->alat_kode] = $this->stokNow[$item->alat_kode] - $this->stokTerpakai[$item->alat_kode];
            }

        }

    }

    public function render(){
        $data = \Cart::session( auth()->id())->getContent();

        return view('livewire.member.cart.cart')->with(['data'=>$data]);

    }


    public function addqty($id){

        if($this->stokNow[$id] == $this->stok[$id]){
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Stok sudah Maximal',
                'timer'=>3000,
                'icon'=>'info',
                'toast'=>true,
                'position'=>'top-right',
                'showConfirmButton' => false
            ]);
        }

        else{

            $qty = 1 + $this->stok[$id];

            \Cart::session( auth()->id())->update($id,[
                'quantity' => array(
                    'relative' => false,
                    'value' => $qty,
                )
            ]);

            $this->emit('cartAdded');

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Total Telah ditambah',
                'timer'=>3000,
                'icon'=>'success',
                'toast'=>true,
                'position'=>'top-right',
                'showConfirmButton' => false
            ]);
        }
        return $this->mount();

    }

    public function removeqty($id){


        $qty = $this->stok[$id] - 1;

        if($qty == 0){

            \Cart::session(auth()->id())->remove($id);
            $this->emit('cartAdded');
            return $this->mount();
        }
        else{

            \Cart::session( auth()->id())->update($id,[
                'quantity' => array(
                    'relative' => false,
                    'value' => $qty,
                )
            ]);
        }

        $this->emit('cartAdded');

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Total Telah Dikurangi',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right',
            'showConfirmButton' => false
        ]);

        return $this->mount();

    }


    public function remove(){

        \Cart::session(auth()->id())->remove($this->rowId);
        $this->emit('cartAdded');

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Data Dihapus',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right',
            'showConfirmButton' => false
        ]);

        unset( $this->harga[$this->rowId] );

        return $this->mount();

    }

    public function checkout(){


        $this->validate([
            'stok.*' => 'required',
            'tglPinjam' => 'required',
            'tglKembali' => 'required',
            'sewaTujuan' => 'required',
        ]);

        $invoice = 'INVC/II/'.Carbon::now()->format('Ymd/His');

        //insert penyewaan
        $createSewa = new Penyewaan();
        $createSewa->sewa_no = $invoice;
        $createSewa->sewa_status = 1;
        $createSewa->sewa_user = auth()->id();
        $createSewa->sewa_tglsewa = $this->tglPinjam;
        $createSewa->sewa_tglkembali = $this->tglKembali;
        $createSewa->sewa_buktitf = 'belum bayar';
        $createSewa->sewa_tujuan = $this->sewaTujuan;
        $createSewa->save();


        // detail sewa
        foreach ($this->stok as $key => $value) {

            $detail = new DetailSewa();

            $detail->detail_sewa_alat_kode = $key;
            $detail->detail_sewa_nosewa = $invoice;
            $detail->total_alat = $value;
            $detail->harga_sewa1 = \Cart::session( auth()->id())->get($key)->price;
            $detail->harga_sewa2 = \Cart::session( auth()->id())->get($key)->attributes->harga2;
            $detail->harga_sewa3 = \Cart::session( auth()->id())->get($key)->attributes->harga3;
            $detail->save();

            \Cart::session(auth()->id())->remove($key);

        }

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Pesana Telah Dibuat',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right',
            'showConfirmButton' => false
        ]);

        return $this->clearForm();

    }

    public function clearForm(){
        $this->tglPinjam = null;
        $this->tglKembali = null;
        $this->sumHarga = null;
        $this->estimasi = null;
        $this->sewaTujuan = null;
        $this->stok = [];
        $this->harga = [];
        $this->emit('cartAdded');
        return redirect('/sewa');
    }
}
