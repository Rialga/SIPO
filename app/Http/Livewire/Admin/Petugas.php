<?php

namespace App\Http\Livewire\Admin;

use App\Model\User;
use Livewire\Component;

class Petugas extends Component
{

    public $formPetugas = false;

    public $sortBy = 'user_id';
    public $sortDiraction = 'asc';
    public $showPage = 10;
    public $search='';


    public function render()
    {
        $data = User::where('user_role',1)->search($this->search)
        ->orderBy($this->sortBy, $this->sortDiraction)
        ->paginate($this->showPage);
        return view('livewire.admin.petugas.petugas',['data'=>$data]);
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

    public function showDetailPage($id){
        $this->formMember = true;
    }

    public function clearForm(){

        $this->formPetugas = false;

         $this->sortBy = 'user_id';
         $this->sortDiraction = 'asc';
         $this->showPage = 10;
         $this->search='';

    }
}
