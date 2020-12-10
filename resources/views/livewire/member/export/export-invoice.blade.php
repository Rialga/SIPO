<div>

    <div class="row">
        <div class="col-sm-12 text-sm-center">
            <address>
                <strong> Bukti Pembayaran </strong><br><br>

                <div class="text-sm-left">
                    <table>
                        <tr>
                            <td>Invoice</td>
                            <td>:</td>
                            <td> <b>{{ $dataSewa->sewa_no }}</b> </td>
                        </tr>
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
                                    <td class="text-center"> Rp. {{ $harga[$item->detail_sewa_alat_kode] }} </td>
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
                        <img src="{{ asset("alatImage/Lunas.jpg") }}" width="100px">
                    </div>

            </address>
        </div>
    </div>

</div>

<script type="text/javascript">
    window.onload = function() { window.print(); }
</script>
