<?php

namespace App\Http\Livewire\Admin;

use App\Model\JenisAlat;
use Livewire\Component;
use Livewire\WithPagination;

class Jenis extends Component
{

    use WithPagination;

    public $dataJenis;
    public $fieldJenisAlat;
    public $fieldJenisHarga;
    public $fieldJenisId;


    public $formJenis = false;
    public $updateMode = false;

    public $sortBy = 'jenis_alat_id';
    public $sortDiraction = 'asc';
    public $showPage = 10;
    public $search='';


    // Show View
    public function render()
    {
        $data = JenisAlat::search($this->search)
        ->orderBy($this->sortBy, $this->sortDiraction)
        ->paginate($this->showPage);
        return view('livewire.admin.jenis.jenisShow',['data'=>$data]);
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





    public function clearForm(){
        $this->validate([]);
        $this->fieldJenisAlat = null;
        $this->fieldJenisHarga = null;
        $this->fieldJenisId = null;

        $this->formJenis = false;
        $this->updateMode = false;


         $this->sortBy = 'jenis_alat_id';
         $this->sortDiraction = 'asc';
         $this->showPage = 10;
         $this->search='';

    }
}
