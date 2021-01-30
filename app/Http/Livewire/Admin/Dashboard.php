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

    public $sewa_bulanini = [
        'sewa' => 0,
        'pendapatan'=> 0,
    ];
    public $sewa_hariini ;
    public $totalBiaya = [];

    public $data_label = [];
    public $data_chart = [];

    public $filter = 'Semua';

    public $jenis;

    public function mount(){

        $this->sewa_hariini = Penyewaan::whereDate('created_at', Carbon::now())
                                ->where(function($a){
                                    $a->Where('sewa_status', '!=', 0)->Where('sewa_status', '!=', 7);
                                })->get();

        if(Penyewaan::count() != 0){

            //Data Perminggu

            foreach( CarbonPeriod::create(Carbon::now()->subDays(7), Carbon::now()) as $item){
                $this->data_label['minggu'][] = $item->isoFormat('dddd (D/M/Y)');
                $this->data_chart['minggu'][] = Penyewaan::where('sewa_status',6)->whereDate('created_at', $item->format('Y-m-d'))->count();
            }



            // Data Perbulan
            $bulan = Penyewaan::where('sewa_status',6)->whereMonth('created_at' , Carbon::now()->month)
            ->where(function($a){
                $a->Where('sewa_status', '!=', 0)
                ->Where('sewa_status', '!=', 7);
            })->orderBy('created_at', 'ASC')->pluck('created_at');

            $sebulan = array();
            foreach($bulan as $month){
                $sebulan[carbon::parse($month)->format('Y-m-d')]= carbon::parse($month)->isoFormat('D MMMM Y');
            }

            foreach($sebulan as $tgl => $name){
                $this->data_chart['bulan'][] =
                Penyewaan::where('sewa_status',6)
                ->whereYear('created_at' , Carbon::now()->year)
                ->whereMonth('created_at' , Carbon::now()->month)
                ->whereDate('created_at' , $tgl)
                ->count();
                $this->data_label['bulan'][] = $name;
            }


            // Data per Setahun
            $tahun = Penyewaan::where('sewa_status',6)->whereYear('created_at' , Carbon::now()->year)
            ->orderBy('created_at', 'ASC')->pluck('created_at');

            $setahun = [];

            foreach($tahun as $item){
                $setahun [carbon::parse($item)->format('m')]= carbon::parse($item)->isoFormat('MMMM');
            }

            foreach($setahun as $num => $name){
                $this->data_chart['tahun'][] =
                Penyewaan::where('sewa_status',6)->whereYear('sewa_tglsewa' , Carbon::now()->year)
                ->whereMonth('sewa_tglsewa' , $num)
                ->where(function($a){
                    $a->Where('sewa_status', '!=', 0)
                    ->Where('sewa_status', '!=', 7);
                })->count();

                $this->data_label['tahun'][] = $name;
            }


            $this->totalBiaya = [];
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
                })->sum('total_alat');
            }




            if($this->filter == 'Semua'){
                // Pemasukan semua
                $data = Penyewaan::where('sewa_status', 6)->get();

            }
            elseif($this->filter == 'Bulan Ini'){
                $data = Penyewaan::whereBetween('created_at', [Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d')])
                ->where(function($a){
                    $a->Where('sewa_status',  6);
                })->get();


            }
            else{
                $data = Penyewaan::whereBetween('created_at', [Carbon::now()->startOfYear()->format('Y-m-d'), Carbon::now()->endOfYear()->format('Y-m-d')])
                ->where(function($a){
                    $a->Where('sewa_status',  6);
                })->get();

            }

            foreach($data as $item){

                foreach($item->detail_sewa as $key => $row){

                    $kondisi[$item->sewa_no][$row->alat->alat_kode] = Pengembalian::where('sewa_no' , $item->sewa_no)->where('alat_kode',$row->alat->alat_kode)->get();
                    $totalSewa[$item->sewa_no][$row->alat->alat_kode] = $row->total_alat * $row->alat->jenis_alat->jenis_alat_harga;

                    foreach($kondisi[$item->sewa_no][$row->alat->alat_kode] as $idDenda => $denda){

                        $dendaRusak[$item->sewa_no][$row->alat->alat_kode][$idDenda] = $denda->kondisi_alat->kondisi_dendarusak * $denda->total_kerusakan;

                    }

                    $totalDendaRusak [$item->sewa_no][$row->alat->alat_kode] = array_sum($dendaRusak[$item->sewa_no][$row->alat->alat_kode]);
                    $estAll = Carbon::parse( $item->sewa_tglsewa)->diffInDays( $item->sewa_tglkembali);

                    if($estAll == 1){
                        $hargaAll =$row->harga_sewa1 * $row->total_alat;
                    }
                    elseif($estAll == 2){
                        $hargaAll =$row->harga_sewa2 * $row->total_alat;

                    }
                    elseif($estAll == 3){
                        $hargaAll =$row->harga_sewa3 * $row->total_alat;

                    }
                    else{
                        $lamaAll = $estAll - 3;
                        $hargaAll =  (($row->harga_sewa1 * $lamaAll) + $row->harga_sewa3) * $row->total_alat;
                    }

                    $harga1All[$item->sewa_no][] = $row->harga_sewa1 * $row->total_alat;
                    $totalSewaAlatAll[$item->sewa_no][]= $hargaAll;

                }

                if($item->sewa_tglkembali > $kondisi[$item->sewa_no][$row->alat->alat_kode][0]->pengembalian_waktu ){
                    $estimasiTerlambat[$item->sewa_no] = 0;
                }
                else{
                    $estimasiTerlambat[$item->sewa_no] = Carbon::parse( $item->sewa_tglkembali)->diffInDays( $kondisi[$item->sewa_no][$row->alat->alat_kode][0]->pengembalian_waktu );
                }

                $this->totalBiaya[$item->sewa_no] = (array_sum($totalDendaRusak[$item->sewa_no]) + array_sum($totalSewaAlatAll[$item->sewa_no]) + (array_sum($harga1All[$item->sewa_no]) * $estimasiTerlambat[$item->sewa_no]) );

            }
        }
        $this->dispatchBrowserEvent('chart');

    }


    public function filter($id){
        $this->filter = $id;
        return $this->mount();
    }

    public function render()
    {

        return view('livewire.admin.dashboard.dashboard');
    }



}
