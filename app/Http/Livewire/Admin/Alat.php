<?php

namespace App\Http\Livewire\Admin;

use App\Model\Merk;
use Livewire\Component;
use App\Model\JenisAlat;
use App\Model\GambarAlat;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Model\Alat as ModelAlat;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;


class Alat extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $gambar=[];

    public $dataAlat, $dataMerk, $dataJenis, $dataGambar;

    public $detailAlat, $detailGambar;

    public $selectJenisAlat, $inputJenisAlat , $inputJenisHarga, $selectMerk, $inputMerk, $inputJumlah, $inputTipe, $inputKodeAlat;


    public $countAlat;

    public $idDiv,$idPic,$detailPic;


    public $formAlat = false;
    public $updateMode = false;
    public $detailMode = false;

    public $checkKode = false;
    public $pageJenis = false;
    public $pageMerk = false;

    public $sortBy = 'alat_kode';
    public $sortDiraction = 'asc';
    public $showPage = 10;
    public $search = '';


    // Return View
    public function render()
    {
        $data=   ModelAlat::search($this->search)
        ->orderBy($this->sortBy, $this->sortDiraction)
        ->paginate($this->showPage);

        $this->dataMerk = Merk::all();
        $this->dataJenis = JenisAlat::all();


        return view('livewire.admin.alat.alatShow',['data'=>$data]);
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


    // Check Kode alat
    public function checkKodeAlat(){

        $this->validate([
            'inputKodeAlat' => 'required',
        ]);

        $this->checkKode = true;

        $kode  = $this->inputKodeAlat;

        $this->countAlat = ModelAlat::where('alat_kode',$kode)->count();

    }

    // Create Jenis dan Merk
    public function create(){

        $jenis = new JenisAlat();
        $merk = new Merk();

        if($this->pageJenis == true AND $this->pageMerk == true){


            $this->validate([
                'inputJenisAlat' => 'required',
                'inputJenisHarga' => 'required',
                'inputMerk' => 'required',
                'inputTipe' => 'required',
                'inputJumlah' => 'required',
                'inputKodeAlat' => 'required',
                'gambar.*' => 'required'
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
                'gambar.*' => 'required'
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
                'gambar.*' => 'required'
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
                'gambar.*' => 'required'
            ]);

            $alatMerk = $this->selectMerk;
            $alatJenis = $this->selectJenisAlat;

            return $this->createAlat($alatJenis,$alatMerk);
        }

    }


    // Create Alat
    public function createAlat($alatJenis,$alatMerk){

        $alat = new ModelAlat();
        $alat->alat_kode = $this->inputKodeAlat;
        $alat->alat_jenis = $alatJenis;
        $alat->alat_merk = $alatMerk;
        $alat->alat_tipe = $this->inputTipe;
        $alat->alat_total = $this->inputJumlah;
        $alat->save();

        return $this->createImage();

    }

    // Create Image
    public function createImage(){

        if($pic = $this->gambar){
            foreach ($pic as $fileGambar) {
                $modelGambar = new GambarAlat();

                $name = $this->inputKodeAlat . Str::random(5) . '.jpg';
                $modelGambar->gambar_kodealat = $this->inputKodeAlat;
                $modelGambar->gambar_file = $name;
                $modelGambar->save();
                $fileGambar->storePubliclyAs('gambarAlat',$name);
            }
        }
        return $this->clearForm();
    }



    //Update
    public function update(){
        $this->validate([
            'selectJenisAlat' => 'required',
            'selectMerk' => 'required',
            'inputTipe' => 'required',
            'inputJumlah' => 'required',
        ]);

        if($this->inputKodeAlat){
            $update = ModelAlat::where('alat_kode',$this->inputKodeAlat)->first();
            $update->alat_jenis = $this->selectJenisAlat;
            $update->alat_merk = $this->selectMerk;
            $update->alat_tipe = $this->inputTipe;
            $update->alat_total = $this->inputJumlah;
            $update->update();
        }

        return $this->createImage();

    }

    //Delete Alat
    public function deleteAlat($id){
        if($id){

            $deleteGambar = GambarAlat::where('gambar_kodealat',$id)->get();

            foreach($deleteGambar as $file){
                Storage::disk('public')->delete('gambarAlat/'.$file->gambar_file);
            }

            GambarAlat::where('gambar_kodealat',$id)->delete();
            ModelAlat::where('alat_kode',$id)->delete();
            $this->dataAlat = ModelAlat::all();


        }
    }

    //Delete Image
    public function deletePict($id) {
        if($id){

            GambarAlat::where('gambar_id',$id)->delete();;
            // $this->dataGambar = GambarAlat::where('gambar_kodealat',$this->inputKodeAlat)->get();
        }
    }



    // Show Edit Page
    public function editPage($id){


        $this->dataGambar = GambarAlat::where('gambar_kodealat',$id)->get();

        $fieldAlat = ModelAlat::findOrfail($id);
        $this->inputKodeAlat = $fieldAlat->alat_kode;
        $this->selectJenisAlat = $fieldAlat->alat_jenis;
        $this->selectMerk = $fieldAlat->alat_merk;
        $this->inputTipe = $fieldAlat->alat_tipe;
        $this->inputJumlah = $fieldAlat->alat_total;

        $this->updateMode = true;
        $this->formAlat = true;

    }

    // Show Detail Page
    public function detailPage($id){
        $this->detailAlat = ModelAlat::where('alat_kode',$id)->first();
        $this->detailGambar = GambarAlat::where('gambar_kodealat',$id)->get();
        $this->detailPic = GambarAlat::where('gambar_kodealat',$id)->first();


        $this->idDiv = 0;
        $this->idPic = 0;
        $this->detailMode = true;
    }



    // Menampilkan filed pada page Crate
    public function addAlat(){
        $this->formAlat = true;
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

        $this->validate([]);

        $this->inputKodeAlat = null;
        $this->inputJenisAlat = null;
        $this->inputJenisHarga = null;
        $this->inputMerk = null;
        $this->inputJumlah = null;
        $this->inputTipe = null;
        $this->selectJenisAlat = null;
        $this->selectMerk = null;
        $this->gambar = null;

        $this->formAlat = false;
        $this->updateMode = false;
        $this->detailMode = false;

        $this->pageJenis = false;
        $this->pageMerk = false;
        $this->checkKode = false;

        $this->sortBy = 'alat_kode';
        $this->sortDiraction = 'asc';
        $this->showPage = 10;
        $this->search='';


    }
}
