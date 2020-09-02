<?php

namespace App\Http\Livewire;

use App\Model\Alat;
use Livewire\Component;

class Welcome extends Component
{
    public $dataAlat;

    public function render()
    {
        $this->dataAlat = Alat::all();
        return view('livewire.welcome');
    }
}
