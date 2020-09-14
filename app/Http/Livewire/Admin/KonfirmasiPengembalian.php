<?php

namespace App\Http\Livewire\Admin;

use App\Model\KondisiAlat;
use App\Model\Pengembalian;
use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;

class KonfirmasiPengembalian extends Component
{



    public $pilihKondisi = [];
    public $jumlahKondisi = [];
    public $alatKode = [];

    public $totalHari, $totalAlat , $totalSewa;

    public $field = [];
    public $num = 0;
    public $idField = 0;

    public $dataSewa;
    public $dataKondisi;

    public $currentInvoice;

    public $detailPage = false;
    public $addKondisi = false;
    public $fullDetail = false;

    public $sortBy = 'sewa_no';
    public $sortDiraction = 'asc';
    public $showPage = 10;
    public $search='';


    public function mount(){

        $this->dataKondisi = KondisiAlat::all();

    }

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


    // ad or remove field
    public function addField($num , $idField){


        $num++;
        $this->num = $num;
        array_push($this->field[$idField] ,$num);

    }

    public function removeField($idField,$id){

        unset($this->field[$idField][$id]);

    }


    // Show Detail Sewa
    public function showDetailPage($id){

        $array =[];

        $this->dataSewa = Penyewaan::find($id);

        foreach($this->dataSewa->detail_sewa as $item){

            $harga[] = $item->detail_sewa_total * $item->alat->jenis_alat->jenis_alat_harga;
            $this->alatKode[] = $item->alat->alat_kode;
            $this->field[] = $array = [];

        }

        $this->currentInvoice = $this->dataSewa->sewa_no;

        $this->totalAlat = array_sum($harga);

        $this->totalHari = Carbon::parse( $this->dataSewa->sewa_tglsewa)->diffInDays( $this->dataSewa->sewa_tglkembali );

        $this->totalSewa = $this->totalHari * $this->totalAlat;

        $this->detailPage = true;

    }



    // Create
    public function create(){



        foreach ($this->field as $key => $item){

            foreach ($this->pilihKondisi[$key] as $nomor =>  $data){
                $create = new Pengembalian();
                $create->pengembalian_nosewa = $this->currentInvoice;
                $create->pengembalian_kodealat = $this->alatKode[$key];
                $create->pengembalian_kondisi =  $this->pilihKondisi[$key][$nomor];
                $create->pengembalian_totalrusak =  $this->jumlahKondisi[$key][$nomor];
                $create->pengembalian_waktu = Carbon::now();
                $create->save();

            }

        }
        
        $this->field = [];
        $this->pilihKondisi  = [];
        $this->jumlahKondisi = [];
        $this->addKondisi = false;
        return $this->arrayField();
        $this->addKondisi == false;
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
            return $this->arrayField();
        }


    }



    public function arrayField(){

        $array =[];

        $this->dataSewa = Penyewaan::find($this->currentInvoice);

        foreach($this->dataSewa->detail_sewa as $item){

            $this->field[] = $array = [];

        }
    }

    // clear value variable
    public function clearForm(){


        $this->field = [];

        $this->num = 0;
        $this->idField = 0;

        $this->pilihKondisi  = [];
        $this->jumlahKondisi = [];
        $this->alatKode = [];



        $this->dataSewa = null;
        $this->totalAlat = null;
        $this->totalSewa = null;
        $this->totalHari = null;

        $this->detailPage = false;
        $this->addKondisi = false;
        $this->fullDetail = false;


        $this->sortBy = 'sewa_no';
        $this->sortDiraction = 'asc';
        $this->showPage = 10;
        $this->search='';

        return $this->arrayField();

    }

}
