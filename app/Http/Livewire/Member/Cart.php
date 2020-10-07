<?php

namespace App\Http\Livewire\Member;

use App\Model\DetailSewa;
use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;

class Cart extends Component
{

    public $tglPinjam , $tglKembali, $sumHarga , $estimasi, $sewaTujuan;
    public $stok = [];
    public $harga = [];



    public function mount(){
        $this->harga = [];
        $data = \Cart::session( auth()->id())->getContent();
        foreach($data as $key => $item){
            $this->stok[$key] = $item->quantity;
            $this->harga[] = \Cart::session( auth()->id())->get($key)->getPriceSum() ;
        }

        $this->sumHarga = array_sum($this->harga);
        $this->estimasi = Carbon::parse( $this->tglPinjam )->diffInDays( $this->tglKembali );


    }

    public function render()
    {
        $data = \Cart::session( auth()->id())->getContent();

        return view('livewire.member.cart.cart')->with(['data'=>$data]);

    }


    public function addCart($id){


        \Cart::session( auth()->id())->update($id,[
            'quantity' => array(
                'relative' => false,
                'value' => $this->stok[$id],
            )
        ]);

        $this->emit('cartAdded');
        return $this->mount();

    }


    public function remove($id){

        \Cart::session(auth()->id())->remove($id);
        $this->emit('cartAdded');
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
        $createSewa->sewa_tglbayar = Carbon::now();
        $createSewa->sewa_tujuan = $this->sewaTujuan;
        $createSewa->save();


        // detail sewa
        foreach ($this->stok as $key => $value) {
            $detail = new DetailSewa();

            $detail->detail_sewa_alat_kode = $key;
            $detail->detail_sewa_nosewa = $invoice;
            $detail->detail_sewa_total = $value;
            $detail->save();

            \Cart::session(auth()->id())->remove($key);

        }

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
