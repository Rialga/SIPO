<div class="table-responsive">
    <table class="table table-nowrap table-bordered ">
        <thead>
            <tr>
                <th style="width: 50px;">No.</th>
                <th class="text-center">Item</th>
                <th class="text-center" style="width: 20px;">Harga Sewa</th>
                <th class="text-center" style="width: 20px;">Jumlah</th>
                <th class="text-center">Kondisi</th>
                <th></th>
                <th class="text-center">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataSewa->detail_sewa as $key =>$item)
            <tr>
                <td class="text-center" style="vertical-align: middle;">{{$loop->iteration}}</td>
                <td style="vertical-align: middle;">
                    ({{ $item->alat->alat_kode }}) <br>
                    {{ $item->alat->jenis_alat->jenis_alat_nama }} - {{ $item->alat->merk->merk_nama }} <br>
                    Tipe : {{ $item->alat->alat_tipe }}
                </td>
                <td class="text-center" style="vertical-align: middle;"> Rp. {{ $item->alat->jenis_alat->jenis_alat_harga }} </td>
                <td class="text-center" style="vertical-align: middle;"> {{ $item->detail_sewa_total }} Unit</td>

                <td style="vertical-align: middle;">
                    <table class="table table-borderless">
                        @foreach ( $kondisi[$item->alat->alat_kode] as $row)
                        <tr>
                            <td>{{ $row->kondisi_alat->kondisi_keterangan}}</td>
                            <td> Rp {{ $row->kondisi_alat->kondisi_dendarusak }}</td>
                            <td> x </td>
                            <td> {{ $row->pengembalian_totalrusak }} kerusakan </td>
                        </tr>
                        @endforeach
                    </table>
                </td>

                <td class="text-center" style="vertical-align: middle;"> = </td>
                <td class="text-right" style="vertical-align: middle;"> Rp. {{ number_format($item->detail_sewa_total * $item->alat->jenis_alat->jenis_alat_harga) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="6" class="text-right">Total Alat & Kondisi</td>
                <td class="text-right">Rp. {{ $totalAlat }}</td>
            </tr>
            <tr>
                <td colspan="6" class="text-right">Durasi Peminjaman</td>
                <td class="text-right">{{ $totalHari }} Hari</td>
            </tr>
            <tr>
                <td colspan="6" class="border-0 text-right">
                    <strong>Total Sewa</strong></td>
                <td class="border-0 text-right"><h4 class="m-0"> Rp. {{ $totalSewa }}  </h4></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="d-print-none">
    <div class="float-right">
        <a href="{{ url('/pengembalian') }}" class="btn btn-secondary">Kembali</a>&nbsp; &nbsp;&nbsp;
        <a href="" class="btn btn-success">Konfirmasi Pengembalian</a>
    </div>
</div>
