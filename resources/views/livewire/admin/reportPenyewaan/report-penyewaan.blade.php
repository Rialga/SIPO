<div>
    <livewire:layouts.admin-header />
<livewire:layouts.admin-sidebar />
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Report</h4>

                            <div wire:loading class="spinner-border text-warning" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="row mb-2">
                            <div class="col-sm-6 mb-2">

                                <div class="form-horizontal">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="date" class="form-control mr-2" wire:model.debounce.300ms="tglAwal"/>
                                            <label class="pt-2 mr-2"> - </label>
                                            <input type="date" class="form-control mr-2" wire:model.debounce.300ms="tglAkhir"/>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-4" style="display: flex; justify-content: flex-end">
                                <div class="search-box mr-2 mb-2 d-inline-block">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="(Tujuan/Nama/Inovice)" wire:model.debounce.300ms="search" >
                                        <i class="bx bx-search-alt search-icon"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-2" style="display: flex; justify-content: flex-end">
                                <div class="form-horizontal">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <a wire:click="refresh" class="btn btn-info mr-2" title="refresh" style="color: white"><i class="fas fa-sync-alt"></i></a>
                                            <a wire:click="export" class="btn btn-success mr-2" title="export" style="color: white"><i class="dripicons-print"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                                @if($data->count() == 0)

                                @endif
                                @foreach($data as $key => $item)

                                    <div class="card">
                                        <div class="card-body">
                                            <p> <b>{{ \Carbon\Carbon::parse($item->created_at)->format('d, M Y') }}</b> </p>
                                            <hr width="100%">

                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <a class="mb-4" data-toggle="collapse" href="#hide{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapseExample">
                                                        <b style="color: green"> {{$item->sewa_no}} </b>
                                                    </a>
                                                    <br><br>
                                                    Tujuan :<b> {{ $item->sewa_tujuan }}</b>
                                                </div>

                                                <div class="col-lg-2" style="text-align: center">
                                                        Nama Penyewa : <b>{{  $item->user->user_nama }}</b> <br><br>
                                                </div>

                                                 <div class="col-lg-4" style="text-align: center">
                                                    Tanggal Sewa : <b>{{ \Carbon\Carbon::parse($item->sewa_tglsewa)->format('d, M Y') }}</b> <br>
                                                    Tanggal Kembali : <b>{{ \Carbon\Carbon::parse($item->sewa_tglkembali)->format('d, M Y') }}</b> <br>
                                                    Estimasi : <b> {{ $estimasiSewa[$item->sewa_no] }} Malam</b> <br>

                                                </div>
                                                <div class="col-lg-3" style="text-align: right">
                                                     Total Pembayaran : <br>
                                                    @if(\Carbon\Carbon::parse($item->sewa_tglkembali) > \Carbon\Carbon::parse($item->pengembalian[0]->pengembalian_waktu))
                                                    <h4 style="color: orange"> Rp {{number_format( array_sum($totalDendaRusak[$item->sewa_no]) + $totalSewa[$item->sewa_no] )}} </h4>
                                                    @else
                                                    <h4 style="color: orange"> Rp {{number_format( (array_sum($harga1[$item->sewa_no])  * $estimasiTerlambat[$item->sewa_no] ) + array_sum($totalDendaRusak[$item->sewa_no]) + $totalSewa[$item->sewa_no]  )}} </h4>
                                                    @endif
                                                </div>
                                            </div>

                                            <hr width="100%">

                                            <div class="row collapse" id="hide{{ $loop->iteration }}">
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-bordered ">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 50px;vertical-align: middle;">No.</th>
                                                                <th class="text-center" style="vertical-align: middle;">Item</th>
                                                                <th class="text-center" style="vertical-align: middle;">Biaya Sewa <br> ({{ $estimasiSewa[$item->sewa_no] }} Malam)</th>
                                                                <th class="text-center" style="width: 20px;vertical-align: middle;">Jumlah</th>
                                                                <th class="text-center" width="20">Kondisi Pengembalian</th>
                                                                <th class="text-center" style="vertical-align: middle;">Denda</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($item->detail_sewa as $id =>$row)
                                                            <tr>
                                                                <td class="text-center" style="vertical-align: middle;">{{$loop->iteration}}</td>
                                                                <td style="vertical-align: middle;">
                                                                    ({{ $row->alat->alat_kode }}) <br>
                                                                    {{ $row->alat->jenis_alat->jenis_alat_nama }} - {{ $row->alat->merk->merk_nama }} <br>
                                                                    Tipe : {{ $row->alat->alat_tipe }}<br>
                                                                    Harga : Rp. {{ number_format($row->harga_sewa1) }} / Malam
                                                                </td>
                                                                <td class="text-center" style="vertical-align: middle;"> Rp. {{ number_format($harga[$item->sewa_no][$row->detail_sewa_alat_kode]) }}</td>
                                                                <td class="text-center" style="vertical-align: middle;"> {{ $row->total_alat }} Unit</td>
                                                                <td style="vertical-align: middle;">
                                                                    <table class="table table-borderless">
                                                                        @foreach($kondisi[$item->sewa_no][$row->alat->alat_kode] as $val)
                                                                        <tr>
                                                                            <td width="20px">
                                                                                {{ $val->kondisi_alat->kondisi_keterangan}} <br>
                                                                                Denda : Rp {{ number_format($val->biaya_denda) }}
                                                                            </td>
                                                                            <td>x {{ $val->total_kerusakan }} kerusakan </td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </table>
                                                                </td>
                                                                <td class="text-center" style="vertical-align: middle;">Rp {{ number_format($totalDendaRusak[$item->sewa_no][$row->alat->alat_kode]) }}</td>
                                                            </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="3" class="text-right"><strong> Total Sewa </strong></td>
                                                                <td class="text-right"><h4 class="m-0" style="color: #20b71b"> Rp {{number_format( $totalSewa[$item->sewa_no] )}}  </h4></td>
                                                                <td class="text-right">Total Denda Kerusakan</td>
                                                                <td class="text-right"> Rp {{ number_format(array_sum($totalDendaRusak[$item->sewa_no]))}}</td>
                                                            </tr>
                                                            @if(\Carbon\Carbon::parse($item->sewa_tglkembali) > \Carbon\Carbon::parse($kondisi[$item->sewa_no][$row->alat->alat_kode][0]->pengembalian_waktu))
                                                            <tr>
                                                                <td colspan="5" class="text-right">Denda Keterlambatan <br> <b style="color: #d08b22"> (0 Hari) </b></td>
                                                                <td class="text-right"> Rp 0  </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="5" class="text-right">
                                                                    <strong>Total Denda</strong></td>
                                                                <td class="text-right"><h4 class="m-0" style="color: #d04830"> Rp {{number_format( array_sum($totalDendaRusak[$item->sewa_no]))}}   </h4></td>
                                                            </tr>
                                                            @else
                                                            <tr>
                                                                <td colspan="5" class="text-right">Denda Keterlambatan <br> <b style="color: #d08b22"> ({{ $estimasiTerlambat[$item->sewa_no] }} Hari) </b></td>
                                                                <td class="text-right"> Rp {{number_format( array_sum($harga1[$item->sewa_no])  * $estimasiTerlambat[$item->sewa_no] )}}  </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="5" class="text-right">
                                                                    <strong>Total Denda</strong></td>
                                                                <td class="text-right"><h4 class="m-0" style="color: #d04830"> Rp {{number_format((array_sum($harga1[$item->sewa_no])  * $estimasiTerlambat[$item->sewa_no]) + array_sum($totalDendaRusak[$item->sewa_no]))}}   </h4></td>
                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                                    <div class="row justify-content-end">
                                        <p class="mb-2 mr-2">
                                            Menampilkan {{ $data->firstItem() }} - {{ $data->lastItem() }} dari {{ $data->total() }} item
                                        </p>
                                    </div>

                                    <div class="row mb-0  mr-2">
                                        <div class="col-sm-12">
                                            <div class="row justify-content-end">
                                                <p class="mb-2 mr-2"> {{ $data->links() }} </p>
                                            </div>
                                        </div>
                                    </div>

                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        2020 © Sumbar Mountain Advanture.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-right d-none d-sm-block">
                            SIPO Sumber Mountain Advanture
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<script type="text/javascript">



</script>
