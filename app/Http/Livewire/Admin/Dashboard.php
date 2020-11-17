<?php

namespace App\Http\Livewire\Admin;

use App\Model\DetailSewa;
use App\Model\JenisAlat;
use App\Model\Pengembalian;
use App\Model\Penyewaan;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $sewa_hariini = [
        'sewa',
        'pendapatan',
    ];
    public $sewa_bulanini;
    public $totalBiaya = [];

    public $data_label = [];
    public $data_chart = [];

    public $jenis;
    public function mount(){

        // dd($today->isoFormat('dddd, D MMMM Y'));

        $this->sewa_hariini = Penyewaan::where('created_at', Carbon::now()->format('Y-M-d'))
                                ->where(function($a){
                                    $a->Where('sewa_status', '!=', 0)->Where('sewa_status', '!=', 7);
                                })->get();




        //Data Perminggu

        foreach( CarbonPeriod::create(Carbon::now()->subDays(7), Carbon::now()) as $item){
            $this->data_label['minggu'][] = $item->isoFormat('dddd (D/M/Y)');
            $this->data_chart['minggu'][] = Penyewaan::whereDate('created_at', $item->format('Y-m-d'))->count();
        }


        // Data Perbulan
        $bulan = Penyewaan::whereMonth('created_at' , Carbon::now()->month)
        ->where(function($a){
            $a->Where('sewa_status', '!=', 0)
              ->Where('sewa_status', '!=', 7);
        })->pluck('created_at');

        $sebulan = array();
        foreach($bulan as $month){

            $sebulan[carbon::parse($month)->format('Y-m-d')]= carbon::parse($month)->isoFormat('D MMMM Y');
        }

        foreach($sebulan as $tgl => $name){
            $this->data_chart['bulan'][] =
            Penyewaan::whereYear('created_at' , Carbon::now()->year)
            ->whereMonth('created_at' , $month->month)
            ->whereDate('created_at' , $tgl)
            ->where(function($a){
                $a->Where('sewa_status', '!=', 0)
                  ->Where('sewa_status', '!=', 7);
            })->count();

            $this->data_label['bulan'][] = $name;
        }


        // Data per Setahun
        $tahun = Penyewaan::whereYear('created_at' , Carbon::now()->year)
        ->where(function($a){
            $a->Where('sewa_status', '!=', 0)
              ->Where('sewa_status', '!=', 7);
        })->pluck('created_at');

        foreach($tahun as $item){
            $setahun [carbon::parse($item)->format('m')]= carbon::parse($item)->isoFormat('MMMM');
        }

        foreach($setahun as $num => $name){
            $this->data_chart['tahun'][] =
            Penyewaan::whereYear('created_at' , Carbon::now()->year)
            ->whereMonth('created_at' , $num)
            ->where(function($a){
                $a->Where('sewa_status', '!=', 0)
                  ->Where('sewa_status', '!=', 7);
            })->count();

            $this->data_label['tahun'][] = $name;
        }



        // Jenis Alat jumlah
        foreach(JenisAlat::all() as $item ){

            $this->jenis = $item->jenis_alat_id;

            $this->jenis = $item->jenis_alat_id;
            $this->data_label['alat'][] = $item->jenis_alat_nama;
            $this->data_chart['alat'][] = DetailSewa::whereHas('penyewaan' , function($q){
                return $q->Where('sewa_status', '!=', 0)
                         ->Where('sewa_status', '!=', 7);
            })
            ->whereHas('alat',function($p){
                return $p->whereHas('jenis_alat',function($q){
                     return $q->where('jenis_alat_id' , $this->jenis);
                });
            })->sum('detail_sewa_total');
        }


        //Pemasukan bulanan

        $totalbulanan = Penyewaan::whereBetween('created_at', [Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d')])
        ->where(function($a){
            $a->Where('sewa_status',  6);
        })->get();

        foreach($totalbulanan as $itembulanan){
            foreach($itembulanan->detail_sewa as $key => $rowbulanan){

                $kondisibulanan[$itembulanan->sewa_no][$rowbulanan->alat->alat_kode] = Pengembalian::where('pengembalian_nosewa' , $itembulanan->sewa_no)->where('pengembalian_kodealat',$rowbulanan->alat->alat_kode)->get();
                $totalSewa[$itembulanan->sewa_no][$rowbulanan->alat->alat_kode] = $rowbulanan->detail_sewa_total * $rowbulanan->alat->jenis_alat->jenis_alat_harga;

                foreach($kondisibulanan[$itembulanan->sewa_no][$rowbulanan->alat->alat_kode] as $idDendabulanan => $dendabulanan){

                    $dendaRusakbulanan[$itembulanan->sewa_no][$rowbulanan->alat->alat_kode][$idDendabulanan] = $dendabulanan->kondisi_alat->kondisi_dendarusak * $dendabulanan->pengembalian_totalrusak;

                }

                $totalDendaRusakbulanan [$itembulanan->sewa_no][$rowbulanan->alat->alat_kode] = array_sum($dendaRusakbulanan[$itembulanan->sewa_no][$rowbulanan->alat->alat_kode]);

            }

            $estimasiSewabulanan[$itembulanan->sewa_no] = Carbon::parse( $itembulanan->sewa_tglsewa)->diffInDays( $itembulanan->sewa_tglkembali);
            $estimasiTerlambatbulanan[$itembulanan->sewa_no] = Carbon::parse( $itembulanan->sewa_tglkembali)->diffInDays( $kondisibulanan[$itembulanan->sewa_no][$rowbulanan->alat->alat_kode][0]->pengembalian_waktu );
            $totalBiayabulanan[$itembulanan->sewa_no] = (array_sum($totalSewa[$itembulanan->sewa_no] ) * $estimasiTerlambatbulanan[$itembulanan->sewa_no]) + array_sum($totalDendaRusakbulanan[$itembulanan->sewa_no]) + (array_sum($totalSewa[$itembulanan->sewa_no] ) * $estimasiSewabulanan[$itembulanan->sewa_no] );
        }



        $this->sewa_bulanini['sewa'] = $totalbulanan->count();
        $this->sewa_bulanini['pendapatan'] = array_sum($totalBiayabulanan);



        // Pemasukan semua
        $data = Penyewaan::where('sewa_status', 6)->get();
        foreach($data as $item){


            foreach($item->detail_sewa as $key => $row){

                $kondisi[$item->sewa_no][$row->alat->alat_kode] = Pengembalian::where('pengembalian_nosewa' , $item->sewa_no)->where('pengembalian_kodealat',$row->alat->alat_kode)->get();
                $totalSewa[$item->sewa_no][$row->alat->alat_kode] = $row->detail_sewa_total * $row->alat->jenis_alat->jenis_alat_harga;

                foreach($kondisi[$item->sewa_no][$row->alat->alat_kode] as $idDenda => $denda){

                    $dendaRusak[$item->sewa_no][$row->alat->alat_kode][$idDenda] = $denda->kondisi_alat->kondisi_dendarusak * $denda->pengembalian_totalrusak;

                }

                $totalDendaRusak [$item->sewa_no][$row->alat->alat_kode] = array_sum($dendaRusak[$item->sewa_no][$row->alat->alat_kode]);

            }

            $estimasiSewa[$item->sewa_no] = Carbon::parse( $item->sewa_tglsewa)->diffInDays( $item->sewa_tglkembali);
            $estimasiTerlambat[$item->sewa_no] = Carbon::parse( $item->sewa_tglkembali)->diffInDays( $kondisi[$item->sewa_no][$row->alat->alat_kode][0]->pengembalian_waktu );
            $this->totalBiaya[$item->sewa_no] = (array_sum($totalSewa[$item->sewa_no] ) * $estimasiTerlambat[$item->sewa_no]) + array_sum($totalDendaRusak[$item->sewa_no]) + (array_sum($totalSewa[$item->sewa_no] ) * $estimasiSewa[$item->sewa_no] );
        }



    }

    public function render()
    {
        return view('livewire.admin.dashboard.dashboard');
    }


}
