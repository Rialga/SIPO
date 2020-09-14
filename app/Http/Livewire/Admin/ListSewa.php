<?php

namespace App\Http\Livewire\Admin;

use App\Model\Alat;
use App\Model\DetailSewa;
use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;

class ListSewa extends Component
{

    public $invoice, $tglPinjam , $tglKembali , $sewaNohp , $sewaNama , $sewaTujuan, $tglBayar, $sewaStatus, $fullPrice , $totalHari;

    public $sewaTglCreate = null;

    public $alat = [];
    public $stok = [];

    public $dataSewa , $dataAlat;

    public $formSewa = false;
    public $detailPage = false;

    public $hargaTotal = 0;

    public $inputs = [];
    public $num = 0;


    public $sortBy = 'sewa_no';
    public $sortDiraction = 'asc';
    public $showPage = 10;
    public $search='';


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

    // Fungsi Harga Total
    public function checkTotal(){


        foreach ($this->stok as $key => $value) {

            $alat = Alat::where('alat_kode', $this->alat[$key])->first();

            $harga = $alat->jenis_alat->jenis_alat_harga;

            $total = $harga * $this->stok[$key];

            $price[] = $total;

        }

             $this->hargaTotal = array_sum($price);

    }


    // add field
    public function add($num, $val)
    {
        $num++;
        $this->num = $num;
        array_push($this->inputs ,$num);

        return $this->checkTotal();

    }

    public function remove($num , $val)
    {

        unset($this->stok[$val]);
        unset($this->alat[$val]);

        unset($this->inputs[$num]);

        return $this->checkTotal();


    }


    // Create
    public function create(){

        $invoice = 'INVC/II/'.Carbon::now()->format('Ymd/His');

        $createSewa = new Penyewaan();

        $createSewa->sewa_no = $invoice;
        $createSewa->sewa_jenis = 2;
        $createSewa->sewa_status = 3;
        $createSewa->sewa_tglsewa = $this->tglPinjam;
        $createSewa->sewa_tglkembali = $this->tglKembali;
        $createSewa->sewa_offphone = $this->sewaNohp;
        $createSewa->sewa_offnama = $this->sewaNama;
        $createSewa->sewa_buktitf = 'Lunas';
        $createSewa->sewa_tglbayar = Carbon::now();
        $createSewa->sewa_tujuan = $this->sewaTujuan;

        $createSewa->save();

        foreach ($this->stok as $key => $value) {
            $detail = new DetailSewa();

            $detail->detail_sewa_alat_kode = $this->alat[$key];
            $detail->detail_sewa_nosewa = $invoice;
            $detail->detail_sewa_total = $this->stok[$key];

            $detail->save();

        }

        return $this->clearForm();

    }


    // Upadate Status
    public function updateStatus($id){
        $status = Penyewaan::where('sewa_no' , $id)->first();

        if($status->sewa_status == 3){


            foreach($status->detail_sewa as $item){

                $updateStok = Alat::where('alat_kode',$item->alat->alat_kode)->first();
                $stokNow = $updateStok->alat_total - $item->detail_sewa_total;

                $updateStok->alat_total = $stokNow  ;
                $updateStok->update();
            }

            $status->sewa_status = 4;
            $status->update();
        }

        elseif($status->sewa_status == 4){
            $status->sewa_status = 5;
            $status->update();
        }
        else{
            dd('WTF');
        }

    }


    // Show Edit page
    public function showDetailPage($id){

        $this->dataSewa = Penyewaan::find($id);


        $this->invoice =  $this->dataSewa->sewa_no;
        $this->sewaNama = $this->dataSewa->sewa_offnama;
        $this->sewaNohp = $this->dataSewa->sewa_offphone;
        $this->sewaTujuan = $this->dataSewa->sewa_tujuan;
        $this->tglKembali = $this->dataSewa->sewa_tglkembali;
        $this->tglPinjam = $this->dataSewa->sewa_tglsewa;
        $this->tglBayar = $this->dataSewa->sewa_tglbayar;
        $this->sewaStatus = $this->dataSewa->status_sewa->status_detail;
        $this->sewaTglCreate = Carbon::parse($this->dataSewa->created_at)->format('d, M Y');


        foreach($this->dataSewa->detail_sewa as $item){

            $harga[] = $item->detail_sewa_total * $item->alat->jenis_alat->jenis_alat_harga;

        }

        $this->hargaTotal = array_sum($harga);

        $selisih = Carbon::parse( $this->tglPinjam )->diffInDays( $this->tglKembali );

        $this->totalHari = $selisih;

        $this->fullPrice = $this->totalHari * $this->hargaTotal;



        $this->detailPage = true;
    }

    // Show Page Add
    public function showFormSewa(){
        $this->formSewa = true;
    }

    //Cleat form
    public function clearForm(){

        $this->tglPinjam = null;
        $this->tglKembali = null;
        $this->sewaNama = null;
        $this->sewaNohp = null;
        $this->sewaTujuan = null;
        $this->invoice = null;
        $this->totalHari = null;
        $this->fullPrice = null;


        $this->formSewa = false;
        $this->detailPage = false;

        $this->inputs = [];
        $this->num = 1;


        $this->hargaTotal = 0;

        $this->alat = [];
        $this->stok = [];

        $this->sortBy = 'sewa_no';
        $this->sortDiraction = 'asc';
        $this->showPage = 10;
        $this->search='';

    }

}
