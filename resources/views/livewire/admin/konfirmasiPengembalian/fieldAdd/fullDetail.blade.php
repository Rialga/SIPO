
<div class="table-responsive">
    <table class="table table-nowrap table-bordered ">
        <thead>
            <tr>
                <th style="width: 50px;vertical-align:middle">No.</th>
                <th class="text-center" style="vertical-align:middle">Item</th>
                <th class="text-center" style="width: 20px;vertical-align:middle">Jumlah</th>
                <th class="text-center" style="vertical-align:middle">Harga Sewa <br>({{ $totalHari }} Malam)</th>
                <th class="text-center" width="20" style="vertical-align:middle">Kondisi Pengembalian</th>
                <th class="text-center" style="vertical-align:middle">Denda</th>
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
                    Kondisi : {{ $item->alat->kondisi_terbaru }}
                </td>

                <td class="text-center" style="vertical-align: middle;"> {{ $item->total_alat }} Unit</td>
                <td class="text-right" style="vertical-align: middle;"> Rp. {{ number_format($harga[$item->detail_sewa_alat_kode]) }} </td>

                <td style="vertical-align: middle;">
                    <table class="table table-borderless">
                        @foreach($kondisi[$item->alat->alat_kode] as $row)
                        <tr>
                            <td width="20px">
                                {{ $row->kondisi_alat->kondisi_keterangan}} <br>
                                Denda : Rp {{ number_format($row->biaya_denda) }}
                            </td>
                            <td>x {{ $row->total_kerusakan }} kerusakan </td>
                        </tr>
                        @endforeach
                    </table>
                </td>

                <td class="text-center" style="vertical-align: middle;"> Rp {{number_format($totalDenda[$item->alat->alat_kode])}}  </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-right"><strong> Total Sewa </strong></td>
                <td class="text-right"><h4 class="m-0" style="color: #20b71b"> Rp. {{number_format($totalSewa)}}  </h4></td>
                <td class="text-right">Total Denda Kerusakan</td>
                <td class="text-right"> Rp. {{number_format(array_sum($totalDenda))  }} </td>
            </tr>

            @if(\Carbon\Carbon::parse($dataSewa->sewa_tglkembali) > \Carbon\Carbon::parse($waktuKembali))
                <tr>
                    <td class="text-right" colspan="5">Denda Keterlambatan <br> <b style="color: #d08b22"> (0 Hari) </b></td>
                    <td class="text-right"> Rp. {{ number_format(0) }} </td>
                </tr>
                <tr>
                    <td class="text-right" colspan="5">
                        <strong>Total Denda</strong></td>
                    <td class="text-right"><h4 class="m-0" style="color: #d04830"> Rp. {{number_format(array_sum($totalDenda))}}  </h4></td>
                </tr>
                <tr>
                    <td colspan="5" class="border-0 text-right">
                    <h4> <strong>Total </strong> </h4></td>
                    <td class="border-0 text-right"><h3 class="m-0"> Rp. {{number_format($totalSewa + array_sum($totalDenda))}} </h3></td>
                </tr>
            @else
                <tr>
                    <td class="text-right" colspan="5">Denda Keterlambatan <br> <b style="color: #d08b22"> ({{ \Carbon\Carbon::parse($dataSewa->sewa_tglkembali)->diffInDays( $waktuKembali) }} Hari) </b></td>
                    <td class="text-right"> Rp. {{ number_format(\Carbon\Carbon::parse($dataSewa->sewa_tglkembali)->diffInDays( $waktuKembali) * array_sum($harga1)) }} </td>

                </tr>
                <tr>
                    <td class="text-right" colspan="5">
                        <strong>Total Denda</strong></td>
                    <td class="text-right"><h4 class="m-0" style="color: #d04830"> Rp. {{number_format(array_sum($totalDenda) + (\Carbon\Carbon::parse($dataSewa->sewa_tglkembali)->diffInDays( $waktuKembali) * array_sum($harga1)))}}  </h4></td>
                </tr>
                <tr>
                    <td colspan="5" class="border-0 text-right">
                    <h4> <strong>Total </strong> </h4></td>
                    <td class="border-0 text-right"><h3 class="m-0"> Rp. {{number_format(array_sum($totalDenda) + (\Carbon\Carbon::parse($dataSewa->sewa_tglkembali)->diffInDays( $waktuKembali) * array_sum($harga1)) + $totalSewa)}} </h3></td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<div class="d-print-none">
    <div class="float-right">
        <a href="{{ url('/pengembalian') }}" class="btn btn-secondary">Kembali</a>&nbsp; &nbsp;&nbsp;
        <a class="btn btn-success" style="color: honeydew" data-toggle="modal" data-target="#konfirmasi">Konfirmasi Pengembalian</a>

    </div>
</div>

<div class="modal fade bs-example-modal-center" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="konfirmasi">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body" style="text-align: center">
                    <i class="mdi mdi-alert-circle-outline mb-4 mt-4" style="color: orange; font-size:100px" ></i>
                    <h4 class="mb-4"> Konfirmasi Pengembalian? </h4>
                    <button class="btn btn-success mb-2 mt-2 mr-2" onclick="return false" wire:click="konfirmasiPengembalian"  data-dismiss="modal">Ya</button>
                    <button type="button" class="btn btn-danger waves-effect mb-2 mt-2 ml-2" data-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
</div>
