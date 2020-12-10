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
    public $fieldJenisHarga = [
        '1' => '',
        '2' => '',
        '3' => '',
    ];
    public $fieldJenisId;


    public $formJenis = false;
    public $updateMode = false;

    public $sortBy = 'jenis_alat_id';
    public $sortDiraction = 'asc';
    public $showPage = 10;
    public $search='';

    public $rowId;


    public function modal($id, $type){

        $this->rowId = $id;

        $this->dispatchBrowserEvent('mJenis');


    }


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
            'fieldJenisHarga.*' => 'required',
        ]);

        $jenis = new JenisAlat();
        $jenis->jenis_alat_nama = $this->fieldJenisAlat;
        $jenis->jenis_alat_harga1 = $this->fieldJenisHarga[1];
        $jenis->jenis_alat_harga2 = $this->fieldJenisHarga[2];
        $jenis->jenis_alat_harga3 = $this->fieldJenisHarga[3];
        $jenis->save();

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




    // Update
    public function update(){
        $this->validate([
            'fieldJenisAlat' => 'required',
            'fieldJenisHarga.*' => 'required',
        ]);

        if($this->fieldJenisId){
            $update = JenisAlat::where('jenis_alat_id',$this->fieldJenisId)->first();
            $update->jenis_alat_nama = $this->fieldJenisAlat;
            $update->jenis_alat_harga1 = $this->fieldJenisHarga[1];
            $update->jenis_alat_harga2 = $this->fieldJenisHarga[2];
            $update->jenis_alat_harga3 = $this->fieldJenisHarga[3];
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

            JenisAlat::where('jenis_alat_id',$this->rowId)->delete();
            $this->dataJenis = JenisAlat::all();
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

        $edit = JenisAlat::findOrfail($id);

        $this->fieldJenisId = $id;
        $this->fieldJenisAlat = $edit->jenis_alat_nama;
        $this->fieldJenisHarga[1] = $edit->jenis_alat_harga1;
        $this->fieldJenisHarga[2] = $edit->jenis_alat_harga2;
        $this->fieldJenisHarga[3] = $edit->jenis_alat_harga3;

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
        $this->fieldJenisHarga = [
            '1' => '',
            '2' => '',
            '3' => '',
        ];
        $this->fieldJenisId = null;

        $this->formJenis = false;
        $this->updateMode = false;


         $this->sortBy = 'jenis_alat_id';
         $this->sortDiraction = 'asc';
         $this->showPage = 10;
         $this->search='';

    }
}
