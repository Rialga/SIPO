<?php

namespace App\Http\Livewire\Admin;

use App\Model\Pengembalian;
use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;

class ExportReport extends Component
{

    public $estimasiSewa = [];
    public $estimasiTerlambat = [];
    public $kondisi = [];


    public $dendaTerlambat = [];
    public $totalDendaRusak = [];
    public $totalSewa = [];

    public $harga= [];
    public $harga1 = [];
    public $totalBiaya= [];

    public $tgl = '';
    public $estimasi = [];
    public $search = '';

    public function mount($tgl , $search){

        if($tgl == 'all'){
            $this->estimasi['all'] = 'all';
        }
        else{
            $this->estimasi[] = explode('|', $tgl);
        }

        if($search == 'nulldataisnone'){
            $this->search = '';
        }
        else{
            $this->search = $search;
        }


    }

    public function render()
    {

        if(isset($this->estimasi['all']) ){
            $data = Penyewaan::where('sewa_status' , 6)
            ->searchreport($this->search)
            ->orderBy('created_at','ASC')
            ->paginate();
        }
        elseif($this->estimasi[0][0] == $this->estimasi[0][1]){

            $data = Penyewaan::whereDate('created_at',$this->estimasi[0][0])
            ->where('sewa_status' , 6)
            ->searchreport($this->search)
            ->orderBy('created_at','ASC')
            ->paginate();
        }
        else {
            $data = Penyewaan::whereBetween('created_at',[Carbon::parse($this->estimasi[0][0]) , Carbon::parse($this->estimasi[0][1])->addDays(1)])
            ->where('sewa_status' , 6)
            ->searchreport($this->search)
            ->orderBy('created_at','ASC')
            ->paginate();
        }



        foreach($data as $item){


            foreach($item->detail_sewa as $key => $row){

                $this->kondisi[$item->sewa_no][$row->alat->alat_kode] = Pengembalian::where('sewa_no' , $item->sewa_no)->where('alat_kode',$row->alat->alat_kode)->get();
                $this->estimasiSewa[$item->sewa_no] = Carbon::parse( $item->sewa_tglsewa)->diffInDays( $item->sewa_tglkembali);

                foreach($this->kondisi[$item->sewa_no][$row->alat->alat_kode] as $idDenda => $denda){

                    $dendaRusak[$item->sewa_no][$row->alat->alat_kode][$idDenda] = $denda->biaya_denda * $denda->total_kerusakan;

                }

                $this->totalDendaRusak [$item->sewa_no][$row->alat->alat_kode] = array_sum($dendaRusak[$item->sewa_no][$row->alat->alat_kode]);

                if($this->estimasiSewa[$item->sewa_no] == 1){
                    $this->harga[$item->sewa_no][$row->detail_sewa_alat_kode] =  $row->harga_sewa1;
                }
                elseif($this->estimasiSewa[$item->sewa_no] == 2){
                    $this->harga[$item->sewa_no][$row->detail_sewa_alat_kode] =  $row->harga_sewa2;
                }
                elseif($this->estimasiSewa[$item->sewa_no] == 3){
                    $this->harga[$item->sewa_no][$row->detail_sewa_alat_kode] =  $row->harga_sewa3;
                }
                else{
                    $lama = $this->estimasiSewa[$item->sewa_no] - 3;
                    $this->harga[$item->sewa_no][$row->detail_sewa_alat_kode] =  ($row->harga_sewa1 * $lama) + $row->harga_sewa3;
                }

                $this->harga1[$item->sewa_no][] = $row->harga_sewa1 * $row->total_alat;
                $hargaXqtt[$item->sewa_no][] = $this->harga[$item->sewa_no][$row->detail_sewa_alat_kode] * $row->total_alat;
            }

            // dd($this->harga1);
            $this->totalSewa[$item->sewa_no] = array_sum($hargaXqtt[$item->sewa_no]);

            if(Carbon::parse( $item->sewa_tglkembali) > Carbon::parse( $this->kondisi[$item->sewa_no][$row->alat->alat_kode][0]->pengembalian_waktu)){
                $this->estimasiTerlambat[$item->sewa_no] = 0;
                $this->totalBiaya[$item->sewa_no] =  array_sum($this->totalDendaRusak[$item->sewa_no]) + $this->totalSewa[$item->sewa_no];
            }
            else{
                $this->estimasiTerlambat[$item->sewa_no] = Carbon::parse( $item->sewa_tglkembali)->diffInDays( $this->kondisi[$item->sewa_no][$row->alat->alat_kode][0]->pengembalian_waktu );
                $this->totalBiaya[$item->sewa_no] = (array_sum($this->harga1[$item->sewa_no] ) * $this->estimasiTerlambat[$item->sewa_no]) + array_sum($this->totalDendaRusak[$item->sewa_no]) + $this->totalSewa[$item->sewa_no];
            }

        }


        return view('livewire.admin.export.export-report',['data'=>$data]);
    }
}
