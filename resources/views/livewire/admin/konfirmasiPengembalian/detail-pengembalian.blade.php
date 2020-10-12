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
                                <h4 class="mb-0 font-size-18">Konfirmasi Pengembalian</h4>

                                <div wire:loading class="spinner-border text-warning" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="invoice-title">
                                        <h4 class="float-left font-size-20">{{ $currentInvoice }}</h4> <br><br>
                                        <h4 class="float-left font-size-15">( <b style="color: #0AC8C8"> {{$dataSewa->status_sewa->status_detail }} </b> )</h4> <br>

                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <address>
                                                <strong>Data Penyewa:</strong><br>
                                                    Nama : {{ $dataSewa->user->user_nama }}<br>
                                                    Alamat : {{ $dataSewa->user->user_alamat }}<br>
                                                    Pekerjaan/Sekolah : {{ $dataSewa->user->user_job }}<br>
                                                    HP : {{ $dataSewa->user->user_phone }}<br>
                                            </address>
                                        </div>
                                        <div class="col-sm-6 text-sm-right">
                                            <address>
                                                <strong>Tanggal Pemesanan:</strong><br>
                                                {{ \Carbon\Carbon::parse($dataSewa->createdAt)->format('d, M Y') }}<br><br>
                                            </address>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mt-3">
                                            <address>
                                                <strong>Rentang Peminjaman :</strong><br>
                                                {{  \Carbon\Carbon::parse($dataSewa->sewa_tglsewa)->format('d, M Y') }} - {{ \Carbon\Carbon::parse($dataSewa->sewa_tglkembali)->format('d, M Y') }} <br>
                                                ({{ $totalHari }} Hari) <br>
                                                Tujuan : {{ $dataSewa->sewa_tujuan }} <br>
                                            </address>
                                        </div>

                                        <div class="col-sm-6 mt-3 text-sm-right">
                                            <address>
                                                <strong>Jenis Pembayaran:</strong><br>
                                                di Bayar pada :<br>
                                                {{ \Carbon\Carbon::parse($dataSewa->sewa_tglbayar)->format('d, M Y') }} | {{ \Carbon\Carbon::parse($dataSewa->sewa_tglbayar)->format('H:i') }} WIB<br>
                                            </address>
                                        </div>
                                    </div>

                                    <div class="py-2 mt-3">
                                        <div class="row">
                                            <div class="col-sm-6 mt-4">
                                                <h3 class="font-size-15 font-weight-bold">Detail Sewa</h3>
                                            </div>
                                            <div class="col-sm-6 mt-3">
                                                @if($addKondisi)
                                                    <button wire:click="fieldKondisi('{{ false}}')" type="button" class="btn btn-danger btn-primary waves-effect waves-light mb-2 pt-2 float-right"> Cancel</button>
                                                @elseif($fullDetail)
                                                    <button  type="button" class="btn btn-secondary  waves-effect waves-light mb-2 pt-2 float-right"><i class="fas fa-edit" style="color: white" ></i></button>
                                                @else
                                                    <button wire:click="fieldKondisi('{{ true }}')" type="button" class="btn btn-success btn-primary waves-effect waves-light mb-2 pt-2 float-right"><i class="mdi mdi-plus mr-1"></i> Masukkan Kondisi Alat</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if($addKondisi)
                                        @include('livewire.admin.konfirmasiPengembalian.fieldAdd.fieldAddKondisi')

                                    @elseif($fullDetail)

                                         @include('livewire.admin.konfirmasiPengembalian.fieldAdd.fullDetail')
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 50px;">No.</th>
                                                        <th>Item</th>
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
                                                        <td>
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
                                                    <tr>
                                                        <td colspan="5" class="text-right">Total Alat</td>
                                                        <td class="text-right">Rp. {{ $totalAlat }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" class="text-right">Durasi Peminjaman</td>
                                                        <td class="text-right">{{ $totalHari }} Hari</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" class="border-0 text-right">
                                                            <strong>Total Sewa</strong></td>
                                                        <td class="border-0 text-right"><h4 class="m-0"> Rp. {{ $totalSewa }}  </h4></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="d-print-none">
                                            <div class="float-right">
                                                <a href="{{ url('/pengembalian') }}" class="btn btn-secondary">Kembali</a>&nbsp; &nbsp;&nbsp;
                                            </div>
                                        </div>
                                    @endif

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



