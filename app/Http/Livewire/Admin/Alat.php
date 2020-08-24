<?php

namespace App\Http\Livewire\Admin;

use App\Model\Alat as ModelAlat;
use App\Model\GambarAlat;
use App\Model\JenisAlat;
use App\Model\Merk;
use Livewire\Component;
use Livewire\WithFileUploads;

class Alat extends Component
{
    use WithFileUploads;


    public $gambar;

    public $dataAlat, $dataMerk, $dataJenis;

    public $selectJenisAlat, $inputJenisAlat , $inputJenisHarga, $selectMerk, $inputMerk, $inputJumlah, $inputTipe, $inputKodeAlat;

    protected $listeners = ['dataGambar'=> 'getDataGambar'];

    public $countAlat;


    public $pageAlat = false;
    public $checkKode = false;
    public $pageJenis = false;
    public $pageMerk = false;

    // Store Preview Image saat upload Gambar
    public function getDataGambar($imageData){

        dd($imageData);
        $this->gambar = $imageData;
    }


    public function checkKodeAlat(){

        $this->validate([
            'inputKodeAlat' => 'required',
        ]);

        $this->checkKode = true;

        $kode  = $this->inputKodeAlat;

        $this->countAlat = ModelAlat::where('alat_kode',$kode)->count();

    }





    // Input Database (ALL)
    public function create(){

        $jenis = new JenisAlat();
        $merk = new Merk();
        $gambar = new GambarAlat();


        if($this->pageJenis == true AND $this->pageMerk == true){


            $this->validate([
                'inputJenisAlat' => 'required',
                'inputJenisHarga' => 'required',
                'inputMerk' => 'required',
                'inputTipe' => 'required',
                'inputJumlah' => 'required',
                'inputKodeAlat' => 'required',
            ]);

            $jenis->jenis_alat_nama = $this->inputJenisAlat;
            $jenis->jenis_alat_harga = $this->inputJenisHarga;
            $merk->merk_nama = $this->inputMerk;

            $merk->save();
            $jenis->save();
            $alatJenis = $jenis->all()->last()->jenis_alat_id;
            $alatMerk = $merk->all()->last()->merk_id;

            return $this->createAlat($alatJenis,$alatMerk);

        }
        elseif($this->pageJenis == true AND $this->pageMerk == false){

            $this->validate([
                'inputJenisAlat' => 'required',
                'inputJenisHarga' => 'required',
                'inputTipe' => 'required',
                'inputJumlah' => 'required',
                'inputKodeAlat' => 'required',
                'selectMerk' => 'required',
            ]);

            $jenis->jenis_alat_nama = $this->inputJenisAlat;
            $jenis->jenis_alat_harga = $this->inputJenisHarga;

            $jenis->save();
            $alatJenis = $jenis->all()->last()->jenis_alat_id;
            $alatMerk = $this->selectMerk;

            return $this->createAlat($alatJenis,$alatMerk);

        }
        elseif($this->pageJenis == false AND $this->pageMerk == true){

            $this->validate([
                'inputMerk' => 'required',
                'inputTipe' => 'required',
                'inputJumlah' => 'required',
                'inputKodeAlat' => 'required',
                'selectJenisAlat' => 'required',
            ]);

            $merk->merk_nama = $this->inputMerk;

            $merk->save();
            $alatMerk = $merk->all()->last()->merk_id;
            $alatJenis = $this->selectJenisAlat;

            return $this->createAlat($alatJenis,$alatMerk);
        }
        else{

            $this->validate([
                'selectJenisAlat' => 'required',
                'selectMerk' => 'required',
                'inputTipe' => 'required',
                'inputJumlah' => 'required',
                'inputKodeAlat' => 'required',
            ]);

            $alatMerk = $this->selectMerk;
            $alatJenis = $this->selectJenisAlat;

            return $this->createAlat($alatJenis,$alatMerk);
        }

    }


    // Fungsi Create Alat
    public function createAlat($alatJenis,$alatMerk){
        $alat = new ModelAlat();
        $alat->alat_kode = $this->inputKodeAlat;
        $alat->alat_jenis = $alatJenis;
        $alat->alat_merk = $alatMerk;
        $alat->alat_tipe = $this->inputTipe;
        $alat->alat_total = $this->inputJumlah;
        $alat->save();

        return $this->clearForm();

    }

    // Return View
    public function render()
    {
        $this->dataAlat = ModelAlat::all();
        $this->dataMerk = Merk::all();
        $this->dataJenis = JenisAlat::all();


        return view('livewire.admin.alat.alatShow');
    }



    // Menampilkan Page
    public function addAlat(){
        $this->pageAlat = true;
    }
    public function addJenis(){
        $this->pageJenis = true;
    }
    public function addMerk(){
        $this->pageMerk = true;
    }

    public function cancelAddJenis(){
        $this->inputJenisAlat = null;
        $this->inputJenisHarga = null;
        $this->pageJenis = false;
    }
    public function cancelAddMerk(){
        $this->inputMerk = null;
        $this->pageMerk = false;
    }
    public function cancelAddGambar(){
        $this->gambar = null;
    }


    // Cleaer Form
    public function clearForm(){
        $this->inputKodeAlat = null;
        $this->inputJenisAlat = null;
        $this->inputJenisHarga = null;
        $this->inputMerk = null;
        $this->inputJumlah = null;
        $this->inputTipe = null;
        $this->selectJenisAlat = null;
        $this->selectMerk = null;
        $this->gambar = null;

        $this->pageAlat = false;
        $this->pageJenis = false;
        $this->pageMerk = false;
        $this->checkKode = false;
    }
}
