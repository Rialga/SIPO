<?php

namespace App\Http\Livewire\Admin;

use App\Model\Merk as ModelMerk;
use Livewire\Component;

class Merk extends Component
{

    public $dataMerk;
    public $fieldMerkNama;
    public $fieldMerkId;

    public $formMerk = false;
    public $updateMode = false;


    //Create Data
    public function create(){

        $this->validate([
            'fieldMerkNama' => 'required',
        ]);


        $merk = new ModelMerk();
        $merk->merk_nama = $this->fieldMerkNama;
        $merk->save();

        return $this->clearForm();
    }

    // Update Data
    public function update(){
        $this->validate([
            'fieldMerkNama' => 'required',
        ]);

        if($this->fieldMerkId){
            $update = ModelMerk::where('merk_id',$this->fieldMerkId)->first();
            $update->merk_nama = $this->fieldMerkNama;
            $update->update();
        }

        return $this->clearForm();

    }


    // Delete
    public function delete($id){
        if($id){
            ModelMerk::where('merk_id',$id)->delete();
            $this->dataMerk = ModelMerk::all();
        }
    }


    // Show Page Edit
    public function editPage($id){

        $edit = ModelMerk::findOrfail($id);

        $this->fieldMerkId = $id;
        $this->fieldMerkNama = $edit->merk_nama;


        $this->formMerk = true;
        $this->updateMode = true;

    }


    // Show Page Add
    public function showFormMerk(){
        $this->formMerk = true;
    }

    public function render()
    {
        $this->dataMerk = ModelMerk::all();
        return view('livewire.admin.merk.merkShow');
    }

    public function clearForm(){
        $this->validate([]);
        $this->fieldMerkNama = null;
        $this->fieldMerkId = null;

        $this->formMerk = false;
        $this->updateMode = false;

    }
}
