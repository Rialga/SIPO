<div>

    <livewire:layouts.header />

    <div class="main-content" style="margin: auto;">
        <div class="page-content">
            <div class="container-fluid">

                <div class="row">

                    <livewire:layouts.sidebar />

                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-lg-12">
                                        <h2 class="mb-5">Detail Sewa</h2>
                                        <div class="invoice-title">
                                            <h4 class="float-left font-size-20">{{ $dataSewa->sewa_no }}</h4> <br><br>
                                            <h4 class="float-left font-size-15">
                                                @if($dataSewa->sewa_status == 0)
                                                    <b style="color: red">( {{ $dataSewa->status_sewa->status_detail }} ) </b>
                                                @elseif($dataSewa->sewa_status == 1)
                                                    <b style="color: orange">( {{ $dataSewa->status_sewa->status_detail }} )  </b>
                                                @elseif($dataSewa->sewa_status == 2 or $dataSewa->sewa_status == 3 or $dataSewa->sewa_status == 4 or $dataSewa->sewa_status == 5)
                                                    <b style="color: #0AC8C8">( {{ $dataSewa->status_sewa->status_detail }} )  </b>
                                                @elseif($dataSewa->sewa_status == 6)
                                                    <b style="color: green">( {{ $dataSewa->status_sewa->status_detail }} )  </b>
                                                @else
                                                    <b style="color: red">( {{ $dataSewa->status_sewa->status_detail }} )  </b>
                                                @endif
                                            </h4>
                                            @if($dataSewa->sewa_status == 3 or $dataSewa->sewa_status == 4)
                                            <a wire:click="export" class="btn btn-success waves-effect waves-light float-right" title="export" style="color: white"><i class="dripicons-print"></i></a>
                                            @else
                                            @endif

                                            <br><br>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-8 text-sm-center">
                                                <address>
                                                    <strong>Detail Sewa</strong><br><br>
                                                    <div class="text-sm-left">
                                                        <table>
                                                            <tr>
                                                                <td>Nama</td>
                                                                <td>:</td>
                                                                <td>{{ $dataSewa->user->user_nama }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>No HP</td>
                                                                <td>:</td>
                                                                <td>{{ $dataSewa->user->user_phone }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td> Waktu  </td>
                                                                <td>:</td>
                                                                <td>{{ \Carbon\Carbon::parse($dataSewa->sewa_tglpinjam)->format('d, M Y') }} - {{ \Carbon\Carbon::parse($dataSewa->sewa_tglkembali)->format('d, M Y') }} ({{ $totalHari }} malam)</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tujuan</td>
                                                                <td>:</td>
                                                                <td>{{ $dataSewa->sewa_tujuan }}</td>
                                                            </tr>
                                                        </table>
                                                    </div><br><br>

                                                        <div class="table-responsive">
                                                            <table class="table table-nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 50px;vertical-align:middle">No.</th>
                                                                        <th class="text-left" style="vertical-align:middle">Item</th>
                                                                        <th style="width: 20px;vertical-align:middle">Jumlah</th>
                                                                        <th class="text-center" style="vertical-align:middle">Harga Sewa <br>({{ $totalHari }} Malam)</th>
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
                                                                        <td class="text-right"> Rp. {{ $harga[$item->detail_sewa_alat_kode] }}  </td>
                                                                        <td class="text-right"> = </td>
                                                                        <td class="text-right"> Rp. {{ number_format( $harga[$item->detail_sewa_alat_kode] * $item->total_alat) }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div  class="float-right">
                                                            <table class="text-sm-left">
                                                                <tr>
                                                                    <td style="width:150px"><strong> Total Sewa </strong></td>
                                                                    <td class="text-right"><h4> Rp. {{ number_format($grandTotal) }}</h4></td>
                                                                </tr>
                                                            </table>
                                                        </div>

                                                </address>
                                            </div>
                                            <div class="col-sm-4 text-sm-center">
                                                <address>

                                                    <strong>Bukti Transfer</strong><br><br><br>
                                                    <div>
                                                        <a href="{{ asset("storage/buktiTf/$dataSewa->sewa_buktitf") }}" target="_blank">
                                                            <img class="img-fluid" alt="" src="{{ asset("storage/buktiTf/$dataSewa->sewa_buktitf") }}" width="145">
                                                        </a>
                                                    </div>

                                                </address>
                                            </div>
                                        </div>

                                        @if($detailKembali)
                                        <br><br>
                                        <div class="row">
                                            <div class="col-sm-12 text-sm-center">
                                                <hr>
                                                <address>
                                                    <strong>Detail Pengembalian</strong><br><br>
                                                    <div class="text-sm-left">
                                                        <table>
                                                            <tr>
                                                                <td>Waktu Pengebalian : {{ \Carbon\Carbon::parse($waktuKembali)->format('d, M Y') }}</td>
                                                            </tr>

                                                            <tr>
                                                                <td>pukul : {{ \Carbon\Carbon::parse($waktuKembali)->format('h:i:s') }} WIB</td>
                                                            </tr>
                                                        </table>

                                                    </div><br>

                                                        <div class="table-responsive">
                                                            <table class="table table-nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No  </th>
                                                                        <th class="text-center">Item</th>
                                                                        <th>Kondisi Pengembalian</th>
                                                                        <th class="text-right">Denda Rusak</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($dataSewa->detail_sewa as $key =>$item)
                                                                    <tr>
                                                                        <td class="text-center" style="vertical-align: middle;">{{$loop->iteration}}</td>

                                                                        <td style="vertical-align: middle;">
                                                                            ({{ $item->alat->alat_kode }}) <br>
                                                                            {{ $item->alat->jenis_alat->jenis_alat_nama }} - {{ $item->alat->merk->merk_nama }} <br>
                                                                            Tipe : {{ $item->alat->alat_tipe }}<br>
                                                                        </td>

                                                                        <td style="vertical-align: middle;">
                                                                            <table class="table table-borderless">
                                                                                @foreach($kondisi[$item->alat->alat_kode] as $row)
                                                                                <tr>
                                                                                    <td width="20px" style="text-align: left">
                                                                                        {{ $row->kondisi_alat->kondisi_keterangan}} <br>
                                                                                        Denda : Rp {{ number_format($row->kondisi_alat->kondisi_dendarusak) }}
                                                                                    </td>
                                                                                    <td>x {{ $row->total_kerusakan }} kerusakan </td>
                                                                                </tr>
                                                                                @endforeach
                                                                            </table>
                                                                        </td>

                                                                        <td class="text-center" style="vertical-align: middle;"> Rp {{number_format($totalDenda[$item->alat->alat_kode])}}  </td>

                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>

                                                            </table>
                                                        </div>

                                                        @if(\Carbon\Carbon::parse($dataSewa->sewa_tglkembali) > \Carbon\Carbon::parse($waktuKembali) )
                                                        <a hidden {{ $rentang =  0}}></a>
                                                        @else
                                                        <a hidden {{ $rentang = \Carbon\Carbon::parse($dataSewa->sewa_tglkembali)->diffInDays( $waktuKembali) }}></a>
                                                        @endif

                                                        <div  class="float-right">
                                                            <table class="text-sm-left">
                                                                <tr>
                                                                    <td style="width:150px"> Total Denda Kerusakan </td>
                                                                    <td class="text-right">Rp. {{number_format(array_sum($totalDenda))  }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:150px"> Denda Keterlambatan <br> ({{ $rentang }} Hari)</td>
                                                                    <td class="text-right">Rp. {{number_format(  $rentang * array_sum($harga1)  ) }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:0px"><strong> Total Denda </strong></td>
                                                                    <td class="text-right"><h4> Rp. {{number_format(( $rentang * array_sum($harga1) ) + array_sum($totalDenda)  ) }} </h4></td>
                                                                </tr>
                                                            </table>
                                                        </div>

                                                </address>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="d-print-none mt-4">
                                            <div class="float-right">
                                                <a class="btn btn-secondary" href="{{ url('/sewa') }}">Kembali</a>&nbsp; &nbsp;&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
    </div>

    <livewire:layouts.footer />

</div>
