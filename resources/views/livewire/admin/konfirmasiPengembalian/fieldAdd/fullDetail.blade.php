
<div class="table-responsive">
    <table class="table table-nowrap table-bordered ">
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
            @foreach($dataSewa->detail_sewa as $key =>$item)
            <tr>
                <td class="text-center" style="vertical-align: middle;">{{$loop->iteration}}</td>
                <td style="vertical-align: middle;">
                    ({{ $item->alat->alat_kode }}) <br>
                    {{ $item->alat->jenis_alat->jenis_alat_nama }} - {{ $item->alat->merk->merk_nama }} <br>
                    Tipe : {{ $item->alat->alat_tipe }}<br>
                    Harga : Rp. {{ number_format($item->alat->jenis_alat->jenis_alat_harga) }} / Hari
                </td>

                <td class="text-center" style="vertical-align: middle;"> {{ $item->detail_sewa_total }} Unit</td>
                <td class="text-center" style="vertical-align: middle;"> Rp. {{ number_format($item->detail_sewa_total * $item->alat->jenis_alat->jenis_alat_harga) }}</td>

                <td style="vertical-align: middle;">
                    <table class="table table-borderless">
                        @foreach($kondisi[$item->alat->alat_kode] as $row)
                        <tr>
                            <td width="20px">
                                {{ $row->kondisi_alat->kondisi_keterangan}} <br>
                                Denda : Rp {{ number_format($row->kondisi_alat->kondisi_dendarusak) }}
                            </td>
                            <td>x {{ $row->pengembalian_totalrusak }} kerusakan </td>
                        </tr>
                        @endforeach
                    </table>
                </td>

                <td class="text-center" style="vertical-align: middle;"> Rp {{number_format($totalDenda[$item->alat->alat_kode])}}  </td>
            </tr>
            @endforeach

            <tr>
                <td colspan="3" class="text-right">Total alat</td>
                <td class="text-right">Rp. {{number_format(array_sum($totalAlat))}}</td>
                <td class="text-right">Total Denda Kerusakan</td>
                <td class="text-right"> Rp. {{number_format(array_sum($totalDenda))  }} </td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">Durasi Peminjaman</td>
                <td class="text-right">{{ $totalHari }} Hari</td>
                <td class="text-right">Denda Keterlambatan <br> <b style="color: #d08b22"> ({{ \Carbon\Carbon::parse($dataSewa->sewa_tglkembali)->diffInDays( $waktuKembali) }} Hari) </b></td>
                <td class="text-right"> Rp. {{ number_format(\Carbon\Carbon::parse($dataSewa->sewa_tglkembali)->diffInDays( $waktuKembali) * array_sum($totalAlat)) }} </td>
            </tr>
            <tr>
                <td colspan="3" class="text-right"><strong> Total Sewa </strong></td>
                <td class="text-right"><h4 class="m-0" style="color: #20b71b"> Rp. {{number_format(array_sum($totalAlat ) * $totalHari)}}  </h4></td>
                <td class="text-right">
                    <strong>Total Denda</strong></td>
                <td class="text-right"><h4 class="m-0" style="color: #d04830"> Rp. {{number_format(array_sum($totalDenda) + (\Carbon\Carbon::parse($dataSewa->sewa_tglkembali)->diffInDays( $waktuKembali) * array_sum($totalAlat)))}}  </h4></td>
            </tr>
            <tr>
                <td colspan="5" class="border-0 text-right">
                   <h4> <strong>Total </strong> </h4></td>
                <td class="border-0 text-right"><h3 class="m-0"> Rp. {{number_format((array_sum($totalAlat) * $totalHari) + (\Carbon\Carbon::parse($dataSewa->sewa_tglkembali)->diffInDays( $waktuKembali) * array_sum($totalAlat)) + array_sum($totalDenda))}} </h3></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="d-print-none">
    <div class="float-right">
        <a href="{{ url('/pengembalian') }}" class="btn btn-secondary">Kembali</a>&nbsp; &nbsp;&nbsp;
        <a wire:click="konfirmasiPengembalian" class="btn btn-success" style="color: honeydew">Konfirmasi Pengembalian</a>

    </div>
</div>
