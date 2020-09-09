<?php

namespace App\Http\Livewire\Admin;

use App\Model\Merk as ModelMerk;
use Livewire\Component;
use Livewire\WithPagination;
class Merk extends Component
{

    use WithPagination;
    public $dataMerk;
    public $fieldMerkNama;
    public $fieldMerkId;

    public $formMerk = false;
    public $updateMode = false;

    public $sortBy = 'merk_id';
    public $sortDiraction = 'asc';
    public $showPage = 10;
    public $search='';

    //Show View
    public function render()
    {
        $data = ModelMerk::search($this->search)
        ->orderBy($this->sortBy, $this->sortDiraction)
        ->paginate($this->showPage);
        return view('livewire.admin.merk.merkShow',['data'=>$data]);
    }

    public function sortBy($field){
        if ($this->sortDiraction == 'asc' ){
            $this->sortDiraction = 'desc';
        }
        else{
            $this->sortDiraction = 'asc';
        }

        return $this->sortBy = $field;
    }


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



    public function clearForm(){
        $this->validate([]);
        $this->fieldMerkNama = null;
        $this->fieldMerkId = null;

        $this->formMerk = false;
        $this->updateMode = false;

        $this->sortBy = 'merk_id';
        $this->sortDiraction = 'asc';
        $this->showPage = 10;
        $this->search='';

    }
}
