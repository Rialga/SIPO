<?php

namespace App\Http\Livewire\Admin;

use App\Model\Rekening as ModelRekening;
use Livewire\Component;
use Livewire\WithPagination;

class Rekening extends Component
{

    use WithPagination;
    public $dataRekening;
    public $fieldNamaBank;
    public $fieldAtasNama;
    public $fieldNoRek;

    public $formRekening = false;
    public $updateMode = false;

    public $sortBy = 'rekening_no';
    public $sortDiraction = 'asc';
    public $showPage = 10;
    public $search='';

    public $rowId;

    public function modal($id, $type){
        $this->rowId = $id;
        $this->dispatchBrowserEvent('mRekening');

    }

    public function render()
    {
        $data = ModelRekening::search($this->search)
        ->orderBy($this->sortBy, $this->sortDiraction)
        ->paginate($this->showPage);
        return view('livewire.admin.rekening.rekening',['data'=>$data]);
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
            'fieldNamaBank' => 'required',
            'fieldAtasNama' => 'required',
            'fieldNoRek' => 'required'
        ]);


        $create = new ModelRekening();
        $create->rekening_no = $this->fieldNoRek;
        $create->rekening_bank = $this->fieldNamaBank;
        $create->rekening_an = $this->fieldAtasNama;
        $create->save();

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

    // Update Data
    public function update(){
        // dd($this->fieldNoRek,$this->fieldNamaBank,$this->fieldAtasNama);
        $this->validate([
            'fieldNamaBank' => 'required',
            'fieldAtasNama' => 'required',
            'fieldNoRek' => 'required'
        ]);

        if($this->fieldNoRek){
            $update = ModelRekening::where('rekening_no',$this->fieldNoRek)->first();
            $update->rekening_bank = $this->fieldNamaBank;
            $update->rekening_an = $this->fieldAtasNama;
            $update->update();
        }

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Data Diubah',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right',
            'showConfirmButton' => false
        ]);
        return $this->clearForm();

    }

        // Delete
    public function delete(){

        ModelRekening::where('rekening_no',$this->rowId)->delete();
        $this->dataRekening = ModelRekening::all();

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Data Dihapus',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right',
            'showConfirmButton' => false
        ]);

    }


        // Show Page Edit
    public function editPage($id){

        $edit = ModelRekening::findOrfail($id);

        $this->fieldNoRek = $id;
        $this->fieldAtasNama = $edit->rekening_an;
        $this->fieldNamaBank = $edit->rekening_bank;


        $this->formRekening = true;
        $this->updateMode = true;

    }


    // Show Page Add
    public function showFormRekening(){
        $this->formRekening = true;
    }



    public function clearForm(){
        $this->validate([]);
        $this->fieldNamaBank = null;
        $this->fieldAtasNama = null;
        $this->fieldNoRek = null;

        $this->formRekening = false;
        $this->updateMode = false;

        $this->sortBy = 'rekening_no';
        $this->sortDiraction = 'asc';
        $this->showPage = 10;
        $this->search='';

    }

}
