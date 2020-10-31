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

    public $totalBiaya= [];

    public $tgl = '';
    public $estimasi = [];
    public $search = '';

    public function mount($tgl , $search){

        if($tgl == 'all'){
            $this->estimasi[] = null;
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

        if(count($this->estimasi) != 0 ){
            $data = Penyewaan::where('sewa_status' , 6)
            ->searchreport($this->search)
            ->orderBy('created_at','ASC')
            ->paginate();
        }
        else {
            $data = Penyewaan::where('sewa_status' , 6)
            ->whereBetween('created_at',[$this->estimasi[0][0] , $this->estimasi[0][1]])
            ->searchreport($this->search)
            ->orderBy('created_at','ASC')
            ->paginate();
        }



        foreach($data as $item){


            foreach($item->detail_sewa as $key => $row){

                $this->kondisi[$item->sewa_no][$row->alat->alat_kode] = Pengembalian::where('pengembalian_nosewa' , $item->sewa_no)->where('pengembalian_kodealat',$row->alat->alat_kode)->get();
                $this->totalSewa[$item->sewa_no][$row->alat->alat_kode] = $row->detail_sewa_total * $row->alat->jenis_alat->jenis_alat_harga;

                foreach($this->kondisi[$item->sewa_no][$row->alat->alat_kode] as $idDenda => $denda){

                    $dendaRusak[$item->sewa_no][$row->alat->alat_kode][$idDenda] = $denda->kondisi_alat->kondisi_dendarusak * $denda->pengembalian_totalrusak;

                }

                $this->totalDendaRusak [$item->sewa_no][$row->alat->alat_kode] = array_sum($dendaRusak[$item->sewa_no][$row->alat->alat_kode]);

            }

            $this->estimasiSewa[$item->sewa_no] = Carbon::parse( $item->sewa_tglsewa)->diffInDays( $item->sewa_tglkembali);
            $this->estimasiTerlambat[$item->sewa_no] = Carbon::parse( $item->sewa_tglkembali)->diffInDays( $this->kondisi[$item->sewa_no][$row->alat->alat_kode][0]->pengembalian_waktu );
            $this->totalBiaya[$item->sewa_no] = (array_sum($this->totalSewa[$item->sewa_no] ) * $this->estimasiTerlambat[$item->sewa_no]) + array_sum($this->totalDendaRusak[$item->sewa_no]) + (array_sum($this->totalSewa[$item->sewa_no] ) * $this->estimasiSewa[$item->sewa_no] );
        }

    
        return view('livewire.admin.export.export-report',['data'=>$data]);
    }
}
