<?php

namespace App\Http\Livewire\Admin;

use App\Model\Pengembalian;
use App\Model\Penyewaan;
use Carbon\Carbon;
use Livewire\Component;


class ReportPenyewaan extends Component
{


    public $idHide = 0;

    public $estimasiSewa = [];
    public $estimasiTerlambat = [];
    public $kondisi = [];


    public $dendaTerlambat = [];
    public $totalDendaRusak = [];
    public $totalSewa = [];

    public $tglAwal ='' ;
    public $tglAkhir='';
    public $search='';



    public function render()
    {

        if($this->tglAwal == '' OR $this->tglAkhir == '' ){
            $data = Penyewaan::where('sewa_status' , 6)
            ->searchreport($this->search)
            ->orderBy('created_at','DESC')
            ->paginate(15);
        }
        else {
            $data = Penyewaan::where('sewa_status' , 6)
            ->whereBetween('created_at',[$this->tglAwal , $this->tglAkhir])
            ->searchreport($this->search)
            ->orderBy('created_at','DESC')
            ->paginate(15);
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

            }

            // dd( array_sum($this->totalDendaRusak['INVC/II/20201005/235229']));




        return view('livewire.admin.reportPenyewaan.report-penyewaan',['data'=>$data]);
    }

    public function refresh(){


        $this->tglAkhir = '';
        $this->tglAwal = '';
        $this->search = '';
    }

    public function export(){

        if($this->tglAwal=='' OR $this->tglAkhir ==''){
            $tgl = 'all';
        }
        else{
            $tgl = $this->tglAwal.'|'.$this->tglAkhir;
        }

        if($this->search == ''){
            $search = 'nulldataisnone';
        }
        else{
            $search =  $this->search;
        }

        return redirect('/export/'.$tgl.'/'.$search);

    }

}
