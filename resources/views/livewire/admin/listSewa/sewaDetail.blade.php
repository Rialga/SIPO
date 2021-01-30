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
                                <h4 class="mb-0 font-size-18">Sewa</h4>

                                <h4 wire:loading> Loading . . . </h4>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="invoice-title">
                                        <h4 class="float-left font-size-20">{{ $dataSewa->sewa_no }}</h4> <br><br>
                                        <h4 class="float-left font-size-15">( {{ $dataSewa->status_sewa->status_detail }} )</h4>
                                        @if($dataSewa->sewa_status == 1)
                                        <a class="btn btn-danger float-right"  data-toggle="modal" data-target="#mbatal" style="color: white">Batalkan Sewa</a> <br><br>
                                        @endif
                                        <br>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <address>
                                                <strong>Data Penyewa:</strong><br>
                                                Member ID : {{ $dataSewa->user->user_id }}<br>
                                                Nama : {{ $dataSewa->user->user_nama }}<br>
                                                HP : {{ $dataSewa->user->user_phone}}<br>
                                            </address>
                                        </div>
                                        <div class="col-sm-6 text-sm-right">
                                            <address>
                                                <strong>Tanggal Pemesanan:</strong><br>
                                                {{ \Carbon\Carbon::parse($dataSewa->created_at)->format('d, M Y') }}<br><br>
                                            </address>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mt-3">

                                            <address>
                                                <strong>Rentang Peminjaman :</strong><br>
                                                {{  \Carbon\Carbon::parse($dataSewa->sewa_tglsewa)->format('d, M Y') }} - {{ \Carbon\Carbon::parse($dataSewa->sewa_tglkembali)->format('d, M Y') }} <br>
                                                ({{ $totalHari }} Malam) <br>
                                                Tujuan : {{ $dataSewa->sewa_tujuan }} <br>
                                            </address>


                                        </div>

                                        <div class="col-sm-6 mt-3 text-sm-right">
                                            <address>
                                                <strong>Waktu Pembayaran:</strong><br>
                                                {{ \Carbon\Carbon::parse($dataSewa->sewa_tglbayar)->format('d, M Y') }} | {{ \Carbon\Carbon::parse($dataSewa->sewa_tglbayar)->format('H:i') }} WIB<br>
                                                @if($dataSewa->sewa_status > 1)
                                                    Pembayaran via : Bank {{ $dataSewa->rekening->rekening_bank }}
                                                @endif
                                            </address>
                                        </div>

                                        @if($dataSewa->sewa_status == 6)
                                        <div class="col-sm-12 mt-3 text-sm-right">
                                            <address>
                                                <strong>Waktu Pengembalian:</strong><br>
                                                {{ \Carbon\Carbon::parse($dataSewa->pengembalian[0]->pengembalian_tgl)->format('d, M Y') }} | {{ \Carbon\Carbon::parse($dataSewa->pengembalian[0]->pengembalian_tgl)->format('H:i') }} WIB <br>
                                            </address>
                                        </div>
                                        @endif
                                    </div>

                                        <div class="py-2 mt-3">
                                            <div class="row">
                                                <div class="col-sm-6 mt-4">
                                                    <h3 class="font-size-15 font-weight-bold">Detail Sewa</h3>
                                                </div>
                                                @if($dataSewa->sewa_status == 1)
                                                <div class="col-sm-6 mt-3">
                                                    <a class="btn btn-success float-right"  data-toggle="modal" data-target="#mupdate" style="color: white">Pembayaran Lunas (Transaksi Dilokasi)</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        @if($dataSewa->sewa_status != 6)
                                        <div class="table-responsive">
                                            <table class="table table-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 50px;vertical-align:middle">No.</th>
                                                        <th class="text-left" style="vertical-align:middle">Item</th>
                                                        <th style="width: 20px;vertical-align:middle">Jumlah</th>
                                                        <th class="text-right" style="vertical-align:middle">Harga Sewa <br>({{ $totalHari }} Malam)</th>
                                                        <th class="text-right"></th>
                                                        <th class="text-right" style="vertical-align:middle">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dataSewa->detail_sewa as $item)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td class="text-left">
                                                            ({{ $item->alat->alat_kode }}) <br>
                                                            {{ $item->alat->jenis_alat->jenis_alat_nama }} - {{ $item->alat->merk->merk_nama }} <br>
                                                            Tipe : {{ $item->alat->alat_tipe }}
                                                        </td>
                                                        <td class="text-center"> {{ $item->total_alat }} Unit</td>
                                                        <td class="text-right"> Rp. {{ $harga[$item->detail_sewa_alat_kode] }} </td>
                                                        <td class="text-right"> = </td>
                                                        <td class="text-right"> Rp. {{ number_format( $harga[$item->detail_sewa_alat_kode] * $item->total_alat) }}</td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="5" class="border-0 text-right">
                                                            <strong>Total Sewa</strong></td>
                                                        <td class="border-0 text-right"><h4 class="m-0"> Rp. {{ number_format($fullPrice) }}  </h4></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        @else
                                        <div class="table-responsive">
                                            <table class="table table-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 50px;vertical-align: middle">No.</th>
                                                        <th class="text-center" style="vertical-align: middle">Item</th>
                                                        <th class="text-center" style="vertical-align: middle">Biaya Sewa <br> ({{ $totalHari }} malam)</th>
                                                        <th class="text-center" style="width: 20px;vertical-align: middle">Jumlah</th>
                                                        <th class="text-center" style="vertical-align: middle" width="20">Kondisi Pengembalian</th>
                                                        <th class="text-center" style="vertical-align: middle">Denda</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dataSewa->detail_sewa as $row)
                                                    <tr>
                                                        <td class="text-center" style="vertical-align: middle;">{{$loop->iteration}}</td>
                                                        <td style="vertical-align: middle;">
                                                            ({{ $row->alat->alat_kode }}) <br>
                                                            {{ $row->alat->jenis_alat->jenis_alat_nama }} - {{ $row->alat->merk->merk_nama }} <br>
                                                            Tipe : {{ $row->alat->alat_tipe }}<br>
                                                            Harga : Rp. {{ number_format($row->alat->jenis_alat->jenis_alat_harga1) }} / Malam
                                                        </td>
                                                        <td class="text-center" style="vertical-align: middle;"> Rp. {{ number_format($harga[$row->detail_sewa_alat_kode] )}}</td>
                                                        <td class="text-center" style="vertical-align: middle;"> {{ $row->total_alat }} Unit</td>
                                                        <td style="vertical-align: middle;">
                                                            <table class="table table-borderless">
                                                                @foreach($dataSewa->pengembalian->where('alat_kode',$row->alat->alat_kode) as $val)
                                                                <a hidden {{ $totalDendaRusak[$row->alat->alat_kode][] = $val->kondisi_alat->kondisi_dendarusak * $val->total_kerusakan }}></a>
                                                                <tr>
                                                                    <td width="20px">
                                                                        {{ $val->kondisi_alat->kondisi_keterangan}} <br>
                                                                        Denda : Rp {{ number_format($val->kondisi_alat->kondisi_dendarusak) }}
                                                                    </td>
                                                                    <td>x {{ $val->total_kerusakan }} kerusakan </td>
                                                                </tr>
                                                                @endforeach
                                                            </table>
                                                        </td>
                                                        <td class="text-center" style="vertical-align: middle;">Rp {{ number_format(array_sum($totalDendaRusak[$row->alat->alat_kode])) }}</td>
                                                        <a hidden {{ $fullDenda[] = array_sum($totalDendaRusak[$row->alat->alat_kode]) }}></a>
                                                    </tr>
                                                    @endforeach

                                                    @if(\Carbon\Carbon::parse($dataSewa->pengembalian[0]->pengembalian_tgl) < \Carbon\Carbon::parse($dataSewa->sewa_tglkembali) )
                                                        <a hidden {{ $estimasi = 0 }}></a>
                                                    @else
                                                        <a hidden {{ $estimasi =  \Carbon\Carbon::parse($dataSewa->sewa_tglkembali)->diffInDays($dataSewa->pengembalian[0]->pengembalian_tgl)}}></a>
                                                    @endif

                                                    <tr>
                                                        <td colspan="3" class="text-right"><strong> Total Sewa </strong></td>
                                                        <td class="text-right"><h4 class="m-0" style="color: #20b71b"> Rp {{number_format($fullPrice)}}  </h4></td>
                                                        <td class="text-right">Total Denda Kerusakan</td>
                                                        <td class="text-right"> Rp {{ number_format(array_sum($fullDenda))}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" class="text-right">Denda Keterlambatan <br> <b style="color: #d08b22"> ({{ $estimasi }} Hari) </b></td>
                                                        <td class="text-right"> Rp  {{ number_format(array_sum($harga1) * $estimasi) }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" class="text-right">
                                                            <strong>Total Denda</strong></td>
                                                        <td class="text-right"><h4 class="m-0" style="color: #d04830"> Rp  {{ number_format( (array_sum($harga1) * $estimasi) + array_sum($fullDenda) ) }} </h4></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                        <div class="d-print-none">
                                            <div class="float-right">
                                                <a href="{{ url('/list-sewa') }}" class="btn btn-secondary">Kembali</a>&nbsp; &nbsp;&nbsp;
                                                @if($dataSewa->sewa_status == 3)
                                                <a class="btn btn-info"  data-toggle="modal" data-target="#mupdate" style="color: white">Perbarui Status</a>
                                                @elseif($dataSewa->sewa_status == 4 )
                                                <a class="btn btn-success"  data-toggle="modal" data-target="#mupdate" style="color: white">Konfirmasi Pengambilan</a>
                                                @else
                                                @endif
                                            </div>
                                        </div>
                                </div>

                                <div class="modal fade bs-example-modal-center" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mupdate">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body" style="text-align: center">
                                                    <i class="mdi mdi-alert-circle-outline mb-4 mt-4" style="color: orange; font-size:100px" ></i>
                                                    @if($dataSewa->sewa_status == 3 )
                                                    <h4 class="mb-2"> Perbarui Status? </h4>
                                                    @elseif($dataSewa->sewa_status == 1)
                                                    <h4 class="mb-2"> Konfirmasi Transkasi di Lokasi? </h4>
                                                    @else
                                                    <h4 class="mb-2"> Konfirmasi Pengambilan? </h4>
                                                    @endif
                                                    <h6 class="mb-2" muted> No Invoice : {{ $dataSewa->sewa_no }} </h6>
                                                    @if($dataSewa->sewa_status == 1 )
                                                    <a class="btn btn-success"  wire:click="konfirmasi" style="color: white" data-dismiss="modal">Ya</a>
                                                    @else
                                                    <a class="btn btn-success"  wire:click="updateStatus" style="color: white" data-dismiss="modal">Ya</a>
                                                    @endif
                                                    <button type="button" class="btn btn-danger waves-effect mb-2 mt-2 ml-2" data-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade bs-example-modal-center" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mbatal">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body" style="text-align: center">
                                                    <i class="mdi mdi-alert-circle-outline mb-4 mt-4" style="color: orange; font-size:100px" ></i>
                                    
                                                    <h4 class="mb-2"> Batalkan Sewa? </h4>
                    
                                                    <h6 class="mb-2" muted> No Invoice : {{ $dataSewa->sewa_no }} </h6>
                                                    <a class="btn btn-success"  wire:click="batal" style="color: white" data-dismiss="modal">Ya</a>
                                                    <button type="button" class="btn btn-danger waves-effect mb-2 mt-2 ml-2" data-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

</div>


