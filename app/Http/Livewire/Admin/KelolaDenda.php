<?php

namespace App\Http\Livewire\Admin;

use App\Model\KondisiAlat;
use Livewire\Component;

class KelolaDenda extends Component
{


    public $dataKondisi;
    public $fieldKondisiKet;
    public $fieldKondisiDenda;
    public $fieldKondisiId;


    public $formKondisi = false;
    public $updateMode = false;


    //Create
    public function create(){

        $this->validate([
            'fieldKondisiKet' => 'required',
            'fieldKondisiDenda' => 'required',
        ]);

        $create = new KondisiAlat();
        $create->kondisi_keterangan = $this->fieldKondisiKet;
        $create->kondisi_dendarusak = $this->fieldKondisiDenda;
        $create->save();

        return $this->clearForm();
    }




    // Update
    public function update(){

        $this->validate([
            'fieldKondisiKet' => 'required',
            'fieldKondisiDenda' => 'required',
        ]);


        if($this->fieldKondisiId){
            $update = KondisiAlat::where('kondisi_id',$this->fieldKondisiId)->first();
            $update->kondisi_keterangan = $this->fieldKondisiKet;
            $update->kondisi_dendarusak = $this->fieldKondisiDenda;
            $update->update();
        }

        return $this->clearForm();

    }

    // Delete
    public function delete($id){
        if($id){
            KondisiAlat::where('kondisi_id',$id)->delete();
            $this->dataJenis = KondisiAlat::all();
        }
    }

    // Show Page Edit
    public function editPage($id){

        $edit = KondisiAlat::findOrfail($id);

        $this->fieldKondisiId = $id;
        $this->fieldKondisiKet = $edit->kondisi_keterangan;
        $this->fieldKondisiDenda = $edit->kondisi_dendarusak;

        $this->formKondisi = true;
        $this->updateMode = true;

    }

    // Show Page Add
    public function showFormKondisi(){
        $this->formKondisi = true;
    }


    public function render()
    {
        $this->dataKondisi = KondisiAlat::all();
        return view('livewire.admin.kelolaDenda.kelolaDendaShow');
    }


    public function clearForm(){
        $this->validate([]);
        $this->fieldKondisiDenda = null;
        $this->fieldKondisiKet = null;
        $this->fieldKondisiId = null;

        $this->formKondisi = false;
        $this->updateMode = false;

    }
}
