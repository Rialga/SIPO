<?php

namespace App\Http\Livewire\Admin;

use App\Model\Alat;
use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;

class ListSewa extends Component
{

    public $tglPinjam , $tglKembali , $sewaNohp , $sewaNama , $sewaTujuan;

    public $alat = [];
    public $stok = [];

    public $dataAlat;

    public $formSewa = false;
    public $updateMode = false;


    public $inputs = [];
    public $num = 1;

    public $sortBy = 'jenis_alat_id';
    public $sortDiraction = 'asc';
    public $showPage = 10;
    public $search='';



    // methode mount() ready saat component di render
    public function mount(){

        $this->dataAlat = Alat::all();
    }

    // View
    public function render()
    {
        $data = Penyewaan::orderBy($this->sortBy, $this->sortDiraction)
        ->paginate($this->showPage);
        return view('livewire.admin.listSewa.list-sewa',['data'=>$data]);
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



    // add field

    public function add($num)
    {
        $num++;
        $this->num = $num;
        array_push($this->inputs ,$num);
    }

    public function remove($num)
    {
        unset($this->inputs[$num]);
    }


    // Create
    public function create(){

        $invoice = 'INV/II/'.Carbon::today();

        dd($invoice);

        // foreach ($this->stok as $key => $value) {

        //     $inikey[] = $key;
        //     $inivalue[] = $value;
        // }

    }


    // Upadate
    public function update(){

    }

    // Show Page Add
    public function showFormSewa(){
        $this->formSewa = true;
    }

    //Cleat form
    public function clearForm(){

        $this->formSewa = false;
        $this->updateMode = false;

        $this->inputs = [];
        $this->num = 1;

        $this->alat = [];
        $this->stok = [];
    }

}
