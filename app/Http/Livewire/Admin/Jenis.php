<?php

namespace App\Http\Livewire\Admin;

use App\Model\JenisAlat;
use Livewire\Component;

class Jenis extends Component
{

    public $dataJenis;
    public $fieldJenisAlat;
    public $fieldJenisHarga;

    public function create(){

        $this->validate([
            'fieldJenisAlat' => 'required',
            'fieldJenisHarga' => 'required',
        ]);

        $jenis = new JenisAlat();
        $jenis->jenis_alat_nama = $this->fieldJenisAlat;
        $jenis->jenis_alat_harga = $this->fieldJenisHarga;
        $jenis->save();
    }

    public function render()
    {
        $this->dataJenis = JenisAlat::all();

        return view('livewire.admin.jenis.jenisShow');
    }
}
