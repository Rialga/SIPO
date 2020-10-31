<div>



    <div class="card" >
        <div class="card-body">

            <div class="row">
                <div class="col-lg-9">
                    <div>
                        <h2> Laporan Penyewaan </h2>
                        @if($estimasi[0] != null)
                        <span> Tanggal : {{ \Carbon\Carbon::parse($estimasi[0][0])->format('d, M Y') }} - {{ \Carbon\Carbon::parse($estimasi[0][1])->format('d, M Y') }} </span>
                        @else
                        <span> Semua Rentang Waktu </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3" style="display: flex; justify-content: flex-end">
                    <div style="text-align: center">
                        <h4> Sumbar Mountain Adventure </h4>
                        <a>JL. Dr Moh. Hatta no.25 Kecamatan Pauh Kota Padang Sumatera Barat</a>
                    </div>
                </div>
            </div>


            <hr width="100%">

            <table style="display: flex; justify-content: center">
                <tr style="text-align:center">
                    <td> <h6> <b>Jumlah Penyewaan</b></h6> </td>
                    <td width="100px"> </td>
                    <td> <h6> <b>Total Pemasukan</b></h6> </td>
                </tr>
                <tr style="text-align:center">
                    <td> <h5> {{ $data->count() }} sewa </h5></td>
                    <td></td>
                    <td> <h5> Rp. {{ number_format(array_sum($totalBiaya)) }} </h5></td>
                </tr>
            </table>

            <br><br><br>

            @foreach ($data as $item)

            <table>
                <tr>
                    <td> <h5> {{ \Carbon\Carbon::parse($item->created_at)->format('d, M Y') }} </h5></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>{{ $item->sewa_no }} </b>
                    </td>
                </tr>
                <tr>
                    <td> Nama Penyewa </td>
                    <td> : </td>
                    <td> {{ $item->user->user_nama }} </td>
                </tr>
                <tr>
                    <td> Destinasi</td>
                    <td> : </td>
                    <td> {{ $item->sewa_tujuan }} </td>
                </tr>
                <tr>
                    <td> Tanggal Sewa</td>
                    <td> : </td>
                    <td> {{ \Carbon\Carbon::parse($item->sewa_tglsewa)->format('d, M Y') }} - {{ \Carbon\Carbon::parse($item->sewa_tglkembali)->format('d, M Y') }} ({{ $estimasiSewa[$item->sewa_no] }} Hari) </td>
                </tr>
                <tr>
                    <td> Pengembalian</td>
                    <td> : </td>
                    <td> {{ \Carbon\Carbon::parse($item->pengembalian[0]->pengembalian_waktu)->format('d, M Y') }}</td>
                </tr>
                <tr>
                    <td> Tota Biaya</td>
                    <td> : </td>
                    <td> <b> Rp. {{ number_format($totalBiaya[$item->sewa_no]) }} </b> </td>
                </tr>

                <table class="table table-nowrap table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No.</th>
                            <th class="text-center">Item</th>
                            <th class="text-center" style="width: 20px;">Jumlah</th>
                            <th class="text-center">Biaya Sewa</th>
                            <th class="text-center" width="20">Kondisi Pengembalian</th>
                            <th class="text-center">Denda</th>
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
                                Harga : Rp. {{ number_format($row->alat->jenis_alat->jenis_alat_harga) }} / Hari
                            </td>

                            <td class="text-center" style="vertical-align: middle;"> {{ $row->detail_sewa_total }} Unit</td>
                            <td class="text-center" style="vertical-align: middle;"> Rp. {{ number_format($row->detail_sewa_total * $row->alat->jenis_alat->jenis_alat_harga) }}</td>

                            <td style="vertical-align: middle;">
                                <table class="table table-borderless">
                                    @foreach($kondisi[$item->sewa_no][$row->alat->alat_kode] as $val)
                                    <tr>
                                        <td width="20px">
                                            {{ $val->kondisi_alat->kondisi_keterangan}} <br>
                                            Denda : Rp {{ number_format($val->kondisi_alat->kondisi_dendarusak) }}
                                        </td>
                                        <td>x {{ $val->pengembalian_totalrusak }} kerusakan </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td class="text-center" style="vertical-align: middle;">Rp {{ number_format($totalDendaRusak[$item->sewa_no][$row->alat->alat_kode]) }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-right">Total alat</td>
                            <td class="text-right">Rp {{number_format(array_sum($totalSewa[$item->sewa_no]))}}</td>
                            <td class="text-right">Total Denda Kerusakan</td>
                            <td class="text-right"> Rp {{ number_format(array_sum($totalDendaRusak[$item->sewa_no]))}}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">Durasi Peminjaman</td>
                            <td class="text-right">{{ $estimasiSewa[$item->sewa_no] }} Hari</td>

                            <td class="text-right">Denda Keterlambatan <br> <b style="color: #d08b22"> ({{ $estimasiTerlambat[$item->sewa_no] }} Hari) </b></td>
                            <td class="text-right"> Rp {{number_format(array_sum($totalSewa[$item->sewa_no] ) * $estimasiTerlambat[$item->sewa_no] )}}  </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right"><strong> Total Sewa </strong></td>
                            <td class="text-right"><h4 class="m-0" style="color: #20b71b"> Rp {{number_format(array_sum($totalSewa[$item->sewa_no] ) * $estimasiSewa[$item->sewa_no] )}}  </h4></td>
                            <td class="text-right">
                                <strong>Total Denda</strong></td>
                            <td class="text-right"><h4 class="m-0" style="color: #d04830"> Rp {{number_format((array_sum($totalSewa[$item->sewa_no] ) * $estimasiTerlambat[$item->sewa_no]) + array_sum($totalDendaRusak[$item->sewa_no]))}}   </h4></td>
                        </tr>
                        <hr width="100%">
                    </tbody>
                </table>

            </table>

            <br>
            @endforeach

        </div>
    </div>



</div>
