<?php

namespace App\Http\Livewire\Admin;

use App\Model\JenisAlat;
use Livewire\Component;

class Jenis extends Component
{

    public $dataJenis;
    public $fieldJenisAlat;
    public $fieldJenisHarga;
    public $fieldJenisId;


    public $formJenis = false;
    public $updateMode = false;


    //Create
    public function create(){

        $this->validate([
            'fieldJenisAlat' => 'required',
            'fieldJenisHarga' => 'required',
        ]);

        $jenis = new JenisAlat();
        $jenis->jenis_alat_nama = $this->fieldJenisAlat;
        $jenis->jenis_alat_harga = $this->fieldJenisHarga;
        $jenis->save();

        return $this->clearForm();
    }




    // Update
    public function update(){
        $this->validate([
            'fieldJenisAlat' => 'required',
            'fieldJenisHarga' => 'required',
        ]);

        if($this->fieldJenisId){
            $update = JenisAlat::where('jenis_alat_id',$this->fieldJenisId)->first();
            $update->jenis_alat_nama = $this->fieldJenisAlat;
            $update->jenis_alat_harga = $this->fieldJenisHarga;
            $update->update();
        }

        return $this->clearForm();

    }

    // Delete
    public function delete($id){
        if($id){
            JenisAlat::where('jenis_alat_id',$id)->delete();
            $this->dataJenis = JenisAlat::all();
        }
    }

    // Show Page Edit
    public function editPage($id){

        $edit = JenisAlat::findOrfail($id);

        $this->fieldJenisId = $id;
        $this->fieldJenisAlat = $edit->jenis_alat_nama;
        $this->fieldJenisHarga = $edit->jenis_alat_harga;

        $this->formJenis = true;
        $this->updateMode = true;

    }

    // Show Page Add
    public function showFormJenis(){
        $this->formJenis = true;
    }


    // Show View
    public function render()
    {
        $this->dataJenis = JenisAlat::all();
        return view('livewire.admin.jenis.jenisShow');
    }



    public function clearForm(){
        $this->validate([]);
        $this->fieldJenisAlat = null;
        $this->fieldJenisHarga = null;
        $this->fieldJenisId = null;

        $this->formJenis = false;
        $this->updateMode = false;

    }
}
