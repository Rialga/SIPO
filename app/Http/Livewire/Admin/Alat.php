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
use Penyewaan;

class Alat extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $gambar=[];

    public $dataAlat, $dataMerk, $dataJenis, $dataGambar;

    public $detailAlat, $detailGambar;

    public $selectJenisAlat, $inputJenisAlat , $selectMerk, $inputMerk, $inputJumlah, $inputTipe, $inputKodeAlat, $kondisiTerbaru;
    public $inputJenisHarga = [
        '1' => '',
        '2' => '',
        '3' => '',
    ];


    public $countAlat;

    public $idDiv,$idPic,$detailPic;

    public $rowId;

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


    public function modal($id, $type){

        $this->rowId = $id;
        if($type == 'alat'){
            $this->dispatchBrowserEvent('mAlat');
        }
        else{
            $this->dispatchBrowserEvent('mGambar');
        }

    }


    // Return View
    public function render(){

        $data=  ModelAlat::search($this->search)
            ->join('merk', 'alat.alat_merk', '=', 'merk.merk_id')
            ->join('jenis_alat', 'alat.alat_jenis', '=', 'jenis_alat.jenis_alat_id')
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


        $this->countAlat = ModelAlat::where('alat_kode',$this->inputKodeAlat)->count();

    }

    // Create Jenis dan Merk
    public function create(){

        $this->countAlat = ModelAlat::where('alat_kode',$this->inputKodeAlat)->count();

        if($this->countAlat >0){
            $this->checkKode = true;
        }
        else{
            $jenis = new JenisAlat();
            $merk = new Merk();

            if($this->pageJenis == true AND $this->pageMerk == true){


                $this->validate([
                    'inputJenisAlat' => 'required',
                    'inputJenisHarga.*' => 'required',
                    'inputMerk' => 'required',
                    'inputTipe' => 'required',
                    'inputJumlah' => 'required',
                    'inputKodeAlat' => 'required',
                    'kondisiTerbaru' => 'required',
                    'gambar.*' => 'required|max:1024|image',
                ]);

                $jenis->jenis_alat_nama = $this->inputJenisAlat;
                $jenis->jenis_alat_harga1 = $this->inputJenisHarga[1];
                $jenis->jenis_alat_harga2 = $this->inputJenisHarga[2];
                $jenis->jenis_alat_harga3 = $this->inputJenisHarga[3];
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
                    'inputJenisHarga.*' => 'required',
                    'inputTipe' => 'required',
                    'inputJumlah' => 'required',
                    'inputKodeAlat' => 'required',
                    'kondisiTerbaru' => 'required',
                    'selectMerk' => 'required',
                    'gambar.*' => 'required|max:1024|image',
                ]);

                $jenis->jenis_alat_nama = $this->inputJenisAlat;
                $jenis->jenis_alat_harga1 = $this->inputJenisHarga[1];
                $jenis->jenis_alat_harga2 = $this->inputJenisHarga[2];
                $jenis->jenis_alat_harga3 = $this->inputJenisHarga[3];

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
                    'kondisiTerbaru' => 'required',
                    'gambar.*' => 'required|max:1024|image',
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
                    'kondisiTerbaru' => 'required',
                    'gambar.*' => 'required|max:1024|image',
                ]);

                $alatMerk = $this->selectMerk;
                $alatJenis = $this->selectJenisAlat;

                return $this->createAlat($alatJenis,$alatMerk);
            }
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
        $alat->kondisi_terbaru = $this->kondisiTerbaru;
        $alat->save();

        return $this->createImage();

    }

    // Create Image
    public function createImage(){
        $this->validate([
            'gambar.*' => 'required|max:1024|image',
        ]);

        if($pic = $this->gambar){
            foreach ($pic as $fileGambar) {
                $modelGambar = new GambarAlat();

                $name = $this->inputKodeAlat . Str::random(5) . '.jpg';
                $modelGambar->gambar_kodealat = $this->inputKodeAlat;
                $modelGambar->gambar_file = $name;
                $modelGambar->save();
                $fileGambar->storePubliclyAs('gambarAlat/',$name );
            }

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Data Disimpan',
                'timer'=>3000,
                'icon'=>'success',
                'toast'=>true,
                'position'=>'top-right',
                'showConfirmButton' => false
            ]);

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
            $update->kondisi_terbaru = $this->kondisiTerbaru;
            $update->update();
        }

        if($this->gambar){
            return $this->createImage();
        }
        else{
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Data Disimpan',
                'timer'=>3000,
                'icon'=>'success',
                'toast'=>true,
                'position'=>'top-right',
                'showConfirmButton' => false
            ]);

            return $this->clearForm();
        }
    }

    //Delete Alat
    public function deleteAlat(){

        if($this->rowId){

            $deleteGambar = GambarAlat::where('gambar_kodealat',$this->rowId)->get();

            foreach($deleteGambar as $file){
                Storage::disk('public')->delete('gambarAlat/'.$file->gambar_file);
            }

            GambarAlat::where('gambar_kodealat',$this->rowId)->delete();
            ModelAlat::where('alat_kode',$this->rowId)->delete();
            $this->dataAlat = ModelAlat::all();

            $this->inputKodeAlat = '';

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Data Dihapus',
                'timer'=>3000,
                'icon'=>'success',
                'toast'=>true,
                'position'=>'top-right',
                'showConfirmButton' => false
            ]);

        }
    }

    //Delete Image
    public function deletePict() {

        if($this->rowId){

            // dd($this->rowId);
            $gambar =  GambarAlat::where('gambar_id',$this->rowId)->first();
            Storage::disk('public')->delete('gambarAlat/'.$gambar->gambar_file);
            $gambar->delete();
            $this->dataGambar = GambarAlat::where('gambar_kodealat',$this->inputKodeAlat)->get();



            $this->dispatchBrowserEvent('swal', [
                'title' => 'Gambar Dihapus',
                'timer'=>3000,
                'icon'=>'success',
                'toast'=>true,
                'position'=>'top-right',
                'showConfirmButton' => false
            ]);
        }
    }



    // Show Edit Page
    public function editPage($id){


        $this->dataGambar = GambarAlat::where('gambar_kodealat',$id)->get();

        $fieldAlat = ModelAlat::findOrfail($id);
        $this->inputKodeAlat = $id;
        $this->selectJenisAlat = $fieldAlat->alat_jenis;
        $this->selectMerk = $fieldAlat->alat_merk;
        $this->inputTipe = $fieldAlat->alat_tipe;
        $this->inputJumlah = $fieldAlat->alat_total;
        $this->kondisiTerbaru = $fieldAlat->kondisi_terbaru;

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

    public function add($id){

        if($id == 'alat'){
            $this->formAlat = true;
        }
        elseif($id == 'jenis'){
            $this->pageJenis = true;

        }
        else{
            $this->pageMerk = true;
        }

    }


    // cancel addfield
    public function cancel($id){

        if($id == 'addJenis'){
            $this->inputJenisAlat = null;
            $this->inputJenisHarga = [
                '1' => '',
                '2' => '',
                '3' => '',
            ];
            $this->pageJenis = false;
        }
        elseif($id == 'addmerk'){
            $this->inputMerk = null;
            $this->pageMerk = false;
        }
        else{
            $this->gambar = null;
        }

    }

    // Cleaer Form
    public function clearForm(){

        $this->validate([]);

        $this->inputKodeAlat = null;
        $this->inputJenisAlat = null;
        $this->inputJenisHarga = [
            '1' => '',
            '2' => '',
            '3' => '',
        ];
        $this->inputMerk = null;
        $this->inputJumlah = null;
        $this->inputTipe = null;
        $this->selectJenisAlat = null;
        $this->selectMerk = null;
        $this->gambar = null;
        $this->kondisiTerbaru = null;

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
