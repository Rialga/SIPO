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
    public $harga = [];
    public $harga1 = [];


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
        elseif($this->tglAwal == $this->tglAkhir){


            $data = Penyewaan::whereDate('created_at',Carbon::parse($this->tglAwal) )
            ->where('sewa_status' , 6)
            ->searchreport($this->search)
            ->orderBy('created_at','DESC')
            ->paginate(15);
        }
        else {


            $data = Penyewaan::whereBetween('created_at',[Carbon::parse($this->tglAwal) , Carbon::parse($this->tglAkhir)->addDays(1)])
            ->where('sewa_status' , 6)
            ->searchreport($this->search)
            ->orderBy('created_at','DESC')
            ->paginate(15);
        }



            foreach($data as $item){


                $this->estimasiSewa[$item->sewa_no] = Carbon::parse( $item->sewa_tglsewa)->diffInDays( $item->sewa_tglkembali);

                foreach($item->detail_sewa as $key => $row){

                    $this->kondisi[$item->sewa_no][$row->alat->alat_kode] = Pengembalian::where('sewa_no' , $item->sewa_no)->where('alat_kode',$row->alat->alat_kode)->get();

                    foreach($this->kondisi[$item->sewa_no][$row->alat->alat_kode] as $idDenda => $denda){

                        $dendaRusak[$item->sewa_no][$row->alat->alat_kode][$idDenda] = $denda->kondisi_alat->kondisi_dendarusak * $denda->total_kerusakan;

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
                $this->estimasiTerlambat[$item->sewa_no] = Carbon::parse( $item->sewa_tglkembali)->diffInDays( $this->kondisi[$item->sewa_no][$row->alat->alat_kode][0]->pengembalian_waktu );
                $this->totalSewa[$item->sewa_no] = array_sum($hargaXqtt[$item->sewa_no]);
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
