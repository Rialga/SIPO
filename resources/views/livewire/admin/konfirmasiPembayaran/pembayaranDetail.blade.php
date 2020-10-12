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
                                <h4 class="mb-0 font-size-18">Konfirmasi Pembayaran</h4>

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
                                        <h4 class="float-left font-size-15">( <b style="color: orange"> {{$dataSewa->status_sewa->status_detail }} </b> )</h4>
                                        <a class="btn btn-danger waves-effect waves-light float-right" title="Tolak" wire:click="refuse('{{ $dataSewa->sewa_no }}')"> <h6 style="color: white"> Refuse </h6> </a> <br><br>
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
                                                            <td>{{ \Carbon\Carbon::parse($dataSewa->sewa_tglpinjam)->format('d, M Y') }} - {{ \Carbon\Carbon::parse($dataSewa->sewa_tglkembali)->format('d, M Y') }} ({{ $totalHari }} hari)</td>
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
                                                                    <th style="width: 50px;">No.</th>
                                                                    <th class="text-left">Item</th>
                                                                    <th style="width: 20px;">Jumlah</th>
                                                                    <th class="text-right">Harga Sewa</th>
                                                                    <th class="text-right"></th>
                                                                    <th class="text-right">Total</th>
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
                                                                    <td class="text-center"> {{ $item->detail_sewa_total }} Unit</td>
                                                                    <td class="text-right"> Rp. {{ $item->alat->jenis_alat->jenis_alat_harga }} </td>
                                                                    <td class="text-right"> = </td>
                                                                    <td class="text-right"> Rp. {{ number_format($item->detail_sewa_total * $item->alat->jenis_alat->jenis_alat_harga) }}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div  class="float-right">
                                                        <table class="text-sm-left">
                                                            <tr>
                                                                <td style="width:150px"> Total Alat </td>
                                                                <td class="text-right"> Rp.  {{ $subTotal }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:150px"> Durasi Peminjaman </td>
                                                                <td class="text-right"> {{ $totalHari }} Hari</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:0px"><strong> Total Sewa </strong></td>
                                                                <td class="text-right"><h4> Rp. {{ $grandTotal }}</h4></td>
                                                            </tr>
                                                        </table>
                                                    </div>

                                            </address>
                                        </div>
                                        <div class="col-sm-4 text-sm-center">
                                            <address>
                                                <strong>Bukti Transfer</strong><br><br>
                                                <div>
                                                <a class="image-popup-no-margins" href="{{ asset("storage/buktiTf/$dataSewa->sewa_buktitf") }}"  target="_blank">
                                                    <img class="img-fluid" alt="" src="{{ asset("storage/buktiTf/$dataSewa->sewa_buktitf") }}" width="145">
                                                </a>
                                                {{-- <img src="{{ asset("storage/buktiTf/$dataSewa->sewa_buktitf") }}" width="170" height="200" /> --}}
                                                </div>
                                            </address>
                                        </div>
                                    </div>
                                    <div class="d-print-none">
                                        <div class="float-right">
                                            <a  href="{{ url('/konfirmasi-pembayaran') }}" class="btn btn-default">Kembali</a>&nbsp; &nbsp;&nbsp;
                                            <button class="btn btn-success" onclick="return false" wire:click="accept('{{ $dataSewa->sewa_no }}')"> Accept </button>
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



