<?php

namespace App\Http\Livewire\Admin;

use App\Model\Alat;
use App\Model\KondisiAlat;
use App\Model\Pengembalian;
use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;

class DetailPengembalian extends Component
{


    //hybrid
    public $totalSewa , $totalHari;
    public $currentInvoice;
    public $harga = [];
    public $harga1 = [];

    // page Show data
    public $dataKondisi;
    public $dataSewa;
    public $addKondisi = false;
    public $fullDetail = false;

    //page Add Kondisi
    public $pilihKondisi = [];
    public $kTerbaru = [];
    public $jumlahKondisi = [];
    public $alatKode = [];

    public $field = [];
    public $num = 0;
    public $idField = 0;

    // page Konfirmasi pengembalian
    public $waktuKembali;
    public $totalDenda = [];
    public $kondisi = [];


    // mount data
    public function mount($invoice){

        $this->currentInvoice = str_replace("-","/",$invoice);
        return $this->showData();

    }


    // menampilkan data berdasrkan page (show/addkondisi/detailfull)
    public function showData(){

        $this->dataKondisi = KondisiAlat::all();
        $this->dataSewa = Penyewaan::find($this->currentInvoice);
        $this->totalHari = Carbon::parse( $this->dataSewa->sewa_tglsewa)->diffInDays( $this->dataSewa->sewa_tglkembali );

        // full detail page with kondisi alat
        if($this->dataSewa->alat_kembali->count() > 0){

            foreach($this->dataSewa->detail_sewa as $key =>$item){

                $this->kondisi [$item->alat->alat_kode] = Pengembalian::where('sewa_no' , $this->currentInvoice)->where('alat_kode',$item->alat->alat_kode)->get();

                foreach ($this->kondisi[$item->alat->alat_kode] as $id => $data) {
                    $denda[$item->alat->alat_kode][$id] =  $data->biaya_denda * $data->total_kerusakan;
                }

                $this->totalDenda [$item->alat->alat_kode] = array_sum($denda[$item->alat->alat_kode]);
                $this->waktuKembali = $data->pengembalian_waktu;


                if($this->totalHari == 1){
                    $this->harga[$item->detail_sewa_alat_kode] =  $item->harga_sewa1;
                }
                elseif($this->totalHari == 2){
                    $this->harga[$item->detail_sewa_alat_kode] =  $item->harga_sewa2;
                }
                elseif($this->totalHari == 3){
                    $this->harga[$item->detail_sewa_alat_kode] =  $item->harga_sewa3;
                }
                else{
                    $lama = $this->totalHari - 3;
                    $this->harga[$item->detail_sewa_alat_kode] =  ($item->harga_sewa1 * $lama) + $item->harga_sewa3;
                }

                $this->harga1[] = $item->harga_sewa1 * $item->total_alat;
                $hargaXqtt[] = $this->harga[$item->detail_sewa_alat_kode] * $item->total_alat;
            }
            // dd($denda);
            $this->fullDetail = true;

        }
        // untuk edit page dan show detail saja (tidak full)
        else{

            foreach($this->dataSewa->detail_sewa as $item){
                $this->alatKode[] = $item->alat->alat_kode;
                $this->field[] = $array = [];
                $this->kTerbaru[$item->alat->alat_kode] = $item->alat->kondisi_terbaru;
                if($this->totalHari == 1){
                    $this->harga[$item->detail_sewa_alat_kode] =  $item->harga_sewa1;
                }
                elseif($this->totalHari == 2){
                    $this->harga[$item->detail_sewa_alat_kode] =  $item->harga_sewa2;
                }
                elseif($this->totalHari == 3){
                    $this->harga[$item->detail_sewa_alat_kode] =  $item->harga_sewa3;
                }
                else{
                    $lama = $this->totalHari - 3;
                    $this->harga[$item->detail_sewa_alat_kode] =  ($item->harga_sewa1 * $lama) + $item->harga_sewa3;
                }

                $hargaXqtt[] = $this->harga[$item->detail_sewa_alat_kode] * $item->total_alat;

            }

        }

        $this->totalSewa = array_sum($hargaXqtt);

    }


    // jalankan view
    public function render()
    {
        return view('livewire.admin.konfirmasiPengembalian.detail-pengembalian');
    }



    // ad or remove field
    public function addField($num , $idField){
        $num++;
        $this->num = $num;
        array_push($this->field[$idField] ,$num);
    }

    public function removeField($idField,$id ,$value){
        unset($this->pilihKondisi[$idField][$value]);
        unset($this->jumlahKondisi[$idField][$value]);
        unset($this->field[$idField][$id]);
    }


    // Create Kondisi
    public function createKondisi(){


        foreach ($this->field as $key => $item){
            $id = 0;
            $this->validate([
                'pilihKondisi.'.$key.'.'.$id => 'required',
                'jumlahKondisi.'.$key.'.'.$id => 'required',
            ]);


            foreach ($this->field[$key] as $nomor =>  $data){
                $this->validate([
                    'pilihKondisi.'.$key.'.'.$data => 'required',
                    'jumlahKondisi.'.$key.'.'.$data => 'required',
                ]);
            }

            $counts  = array_count_values($this->pilihKondisi[$key]);

            foreach($this->pilihKondisi[$key] as $jml){

                if($counts[$jml] > 1){
                    // dd('yo wassap');

                    return $this->dispatchBrowserEvent('handling');

                }

            }

        }

        // dd($this->pilihKondisi , $this->jumlahKondisi);
        // dd($this->pilihKondisi[1] , 'done lewat' , $this->field);

        foreach ($this->field as $key => $item){

            foreach ($this->pilihKondisi[$key] as $nomor =>  $data){
                $create = new Pengembalian();
                $create->sewa_no = $this->currentInvoice;
                $create->alat_kode = $this->alatKode[$key];
                $create->kondisi_id =  $data;
                $create->total_kerusakan =  $this->jumlahKondisi[$key][$nomor];
                $create->biaya_denda = KondisiAlat::where('kondisi_id',$data)->first()->kondisi_dendarusak;
                $create->pengembalian_waktu = Carbon::now();
                $create->save();
            }
        }

        foreach ($this->kTerbaru as $key => $item){

            $update = Alat::where('alat_kode',$key)->first();
            $update->kondisi_terbaru = $item;
            $update->update();

        }

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Berhasil Tambah Kondisi',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right',
            'showConfirmButton' => false
        ]);

        $this->field = [];
        $this->pilihKondisi  = [];
        $this->jumlahKondisi = [];
        $this->addKondisi = false;
        return $this->clearForm();
    }


    // Konfirmasi pengembalian (tahap akhir)
    public function konfirmasiPengembalian(){

        $this->fullDetail = false;

        foreach ($this->dataSewa->detail_sewa as $data){
            $alat = Alat::where('alat_kode' , $data->alat->alat_kode)->first();
            $alat->alat_total = $alat->alat_total + $data->total_alat;
            $alat->update();
        }

        $update  = Penyewaan::find($this->currentInvoice);
        $update->sewa_status = 6;
        $update->update();

        return redirect('list-sewa/');

    }


    // Set mode add or full detail
    public function fieldKondisi($id){

        if($id == true){
            $this->addKondisi = $id;
        }
        else{
            $this->field = [];
            $this->pilihKondisi  = [];
            $this->jumlahKondisi = [];
            $this->addKondisi = false;
            return $this->clearForm();
        }

    }


    // clear value variable
    public function clearForm(){

        $this->validate([]);
        $this->field = [];

        $this->num = 0;
        $this->idField = 0;

        $this->pilihKondisi  = [];
        $this->jumlahKondisi = [];
        $this->alatKode = [];
        $this->addKondisi = false;
        return $this->showData();

    }

}
