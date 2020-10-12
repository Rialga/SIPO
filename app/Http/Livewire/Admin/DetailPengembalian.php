<?php

namespace App\Http\Livewire\Admin;

use App\Model\KondisiAlat;
use App\Model\Pengembalian;
use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;

class DetailPengembalian extends Component
{

    public $pilihKondisi = [];
    public $jumlahKondisi = [];
    public $alatKode = [];

    public $totalHari, $totalAlat , $totalSewa;

    public $field = [];
    public $num = 0;
    public $idField = 0;

    public $dataSewa;
    public $kondisi = [];
    public $dataPengembalian;

    public $currentInvoice;

    public $addKondisi = false;
    public $fullDetail = false;



    public function mount($invoice){

        $this->currentInvoice = str_replace("-","/",$invoice);



        return $this->showData();

    }


    public function showData(){

        $this->dataKondisi = KondisiAlat::all();
        $this->dataSewa = Penyewaan::find($this->currentInvoice);


        if($this->dataSewa->alat_kembali->count() > 0){



            foreach($this->dataSewa->detail_sewa as $key =>$item){

                $this->kondisi [$item->alat->alat_kode] = Pengembalian::where('pengembalian_nosewa' , $this->currentInvoice)->where('pengembalian_kodealat',$item->alat->alat_kode)->get();

            }


            $this->fullDetail = true;
            $this->totalAlat = 0;
            $this->totalHari = Carbon::parse( $this->dataSewa->sewa_tglsewa)->diffInDays( $this->dataSewa->sewa_tglkembali );
            $this->totalSewa = $this->totalHari * $this->totalAlat;

        }
        else{

            foreach($this->dataSewa->detail_sewa as $item){
                $harga[] = $item->detail_sewa_total * $item->alat->jenis_alat->jenis_alat_harga;
                $this->alatKode[] = $item->alat->alat_kode;
                $this->field[] = $array = [];
            }

            $this->totalAlat = array_sum($harga);
            $this->totalHari = Carbon::parse( $this->dataSewa->sewa_tglsewa)->diffInDays( $this->dataSewa->sewa_tglkembali );
            $this->totalSewa = $this->totalHari * $this->totalAlat;

        }

    }

    public function render()
    {
        return view('livewire.admin.konfirmasiPengembalian.detail-pengembalian');
    }




    // ad or remove field
    public function addField($num , $idField){

        $num++;
        $this->num = $num;
        array_push($this->field[$idField] ,$num);



    }

    public function removeField($idField,$id ,$value){

        unset($this->pilihKondisi[$idField][$value]);
        unset($this->jumlahKondisi[$idField][$value]);

        unset($this->field[$idField][$id]);

    }


    // Create
    public function createKondisi(){


        foreach ($this->field as $key => $item){
            $id = 0;
            $this->validate([
                'pilihKondisi.'.$key.'.'.$id => 'required',
                'jumlahKondisi.'.$key.'.'.$id => 'required',
            ]);


            foreach ($this->field[$key] as $nomor =>  $data){
                $this->validate([
                    'pilihKondisi.'.$key.'.'.$data => 'required',
                    'jumlahKondisi.'.$key.'.'.$data => 'required',
                ]);
            }

        }

        // dd($this->alatKode, $this->pilihKondisi , $this->jumlahKondisi);

        foreach ($this->field as $key => $item){


            foreach ($this->pilihKondisi[$key] as $nomor =>  $data){

                $create = new Pengembalian();
                $create->pengembalian_nosewa = $this->currentInvoice;
                $create->pengembalian_kodealat = $this->alatKode[$key];
                $create->pengembalian_kondisi =  $data;
                $create->pengembalian_totalrusak =  $this->jumlahKondisi[$key][$nomor];
                $create->pengembalian_waktu = Carbon::now();
                $create->save();

            }

        }

        $this->field = [];
        $this->pilihKondisi  = [];
        $this->jumlahKondisi = [];
        $this->addKondisi = false;
        return $this->clearForm();
    }



    // Set mode add or not
    public function fieldKondisi($id){

        if($id == true){
            $this->addKondisi = $id;
        }
        else{
            $this->field = [];
            $this->pilihKondisi  = [];
            $this->jumlahKondisi = [];
            $this->addKondisi = false;
            return $this->clearForm();
        }


    }


    // clear value variable
    public function clearForm(){

        $this->validate([]);
        $this->field = [];

        $this->num = 0;
        $this->idField = 0;

        $this->pilihKondisi  = [];
        $this->jumlahKondisi = [];
        $this->alatKode = [];

        $this->addKondisi = false;

        return $this->showData();

    }

}
