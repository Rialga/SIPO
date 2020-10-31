<?php

namespace App\Http\Livewire\Admin;


use App\Model\Alat;
use App\Model\DetailSewa;
use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;
use Symfony\Component\Console\Input\Input;

class DetailListsewa extends Component
{

    public  $fullPrice , $totalHari, $tglPinjam , $tglKembali, $noSewa , $idlink;
    public $editConfirm ,$deleteConfirm;

    public $alat = [];
    public $stok = [];
    public $stokNow = [];
    public $alatNow = [];

    public $dataSewa , $dataAlat;

    public $hargaTotal = 0;

    public $editPage = false;

    public $inputs = [];
    public $num = 0;



    public function mount($invoice){
        $this->idlink = $invoice;

        $this->noSewa = str_replace("-","/",$invoice);

        return $this->kalkulasi();

    }


    public function kalkulasi(){
        $this->dataSewa = Penyewaan::find($this->noSewa);

        foreach($this->dataSewa->detail_sewa as $item){

            $harga[] = $item->detail_sewa_total * $item->alat->jenis_alat->jenis_alat_harga;

        }

        $this->hargaTotal = array_sum($harga);
        $this->totalHari = Carbon::parse( $this->dataSewa->sewa_tglsewa )->diffInDays( $this->dataSewa->sewa_tglkembali );;
        $this->fullPrice = $this->totalHari * $this->hargaTotal;
    }


    public function render()
    {

        return view('livewire.admin.listSewa.sewaDetail');
    }


    // add field
    public function add($num)
    {

        $kode = $this->alatNow;

        $this->dataAlat = Alat::wherenotin( 'alat_kode' , $kode )->get();

        $num++;
        $this->num = $num;
        array_push($this->alat ,null);
        array_push($this->stok ,null);
        array_push($this->inputs ,$num);

    }

    // remove field
    public function remove($num , $val)
    {
        unset($this->stok[$num]);
        unset($this->alat[$num]);
        unset($this->inputs[$num]);
    }


    public function edit($id){


        if($id == true){
            foreach($this->dataSewa->detail_sewa as $item){
                $this->stokNow[$item->detail_sewa_alat_kode] = $item->detail_sewa_total;
                $this->alatNow[$item->detail_sewa_alat_kode] = $item->detail_sewa_alat_kode;
            }

            $this->tglPinjam = Carbon::parse($this->dataSewa->sewa_tglsewa)->format('yy-m-d');
            $this->tglKembali = Carbon::parse($this->dataSewa->sewa_tglkembali)->format('yy-m-d');
            $this->editPage = $id;
        }

        else{
            return $this->clearForm();
        }


    }


    public function editStok($id){

        DetailSewa::where('detail_sewa_nosewa', $this->dataSewa->sewa_no)->where('detail_sewa_alat_kode', $id)
        ->update([
            'detail_sewa_total' => $this->stokNow[$id]
         ]);

        $this->editConfirm = null;

        return $this->kalkulasi();

    }

    public function removeAlat($id){

        DetailSewa::where('detail_sewa_nosewa', $this->dataSewa->sewa_no)->where('detail_sewa_alat_kode', $id)
        ->delete();

        $this->deleteConfirm = null;

        return $this->kalkulasi();

    }

    public function confirm($action,$id){

        if($action == 'edit'){
            if($this->editConfirm === $id){
                $this->editConfirm = null;
            }
            else{
                $this->editConfirm = $id;
            }

        }
        else{
            if($this->deleteConfirm === $id){
                $this->deleteConfirm = null;
            }
            else{
                $this->deleteConfirm = $id;
            }
        }



    }

    public function update(){


        $this->validate([
            'alat.*' => 'required',
            'stok.*' => 'required',
            'tglPinjam' => 'required',
            'tglKembali' => 'required',
        ]);

        foreach($this->inputs as $key =>$item){
            $detail = new DetailSewa();

            $detail->detail_sewa_alat_kode = $this->alat[$key];
            $detail->detail_sewa_nosewa = $this->noSewa;
            $detail->detail_sewa_total = $this->stok[$key];

            $detail->save();
        }

        return $this->clearForm();

    }

    public function updateStatus(){
        $status = Penyewaan::where('sewa_no' , $this->noSewa)->first();

        if($status->sewa_status == 3){


            foreach($status->detail_sewa as $item){

                $updateStok = Alat::where('alat_kode',$item->alat->alat_kode)->first();
                $stokNow = $updateStok->alat_total - $item->detail_sewa_total;

                $updateStok->alat_total = $stokNow  ;
                $updateStok->update();
            }

            $status->sewa_status = 4;
            $status->update();

            return $this->kalkulasi();
        }

        elseif($status->sewa_status == 4){
            $status->sewa_status = 5;
            $status->update();

            return redirect('detailpengembalian/'.$this->idlink);
        }
        else{
            dd('WTF');
        }

    }



    public function clearForm(){

        $this->validate([]);
        $this->alat = [];
        $this->stok = [];
        $this->stokNow = [];
        $this->alatNow = [];
        $this->inputs = [];

        $this->editConfirm =null;
        $this->deleteConfirm =null;


        $this->editPage = false;

        return $this->kalkulasi();
    }
}
