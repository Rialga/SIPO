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
                                        <a class="btn btn-danger waves-effect waves-light float-right" title="batal" wire:click="batal('{{ $dataSewa->sewa_no }}')"> <h6 style="color: white"> Batalkan Sewa</h6> </a> <br><br>
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
                                            @if($editPage == true)
                                            <address>
                                                <strong>Rentang Peminjaman :</strong><br>
                                                Tgl Pinjam : <input type="date" class="form-control col-sm-6" wire:model.lazy = "tglPinjam"> <br>
                                                Tgl Kembali : <input type="date" class="form-control col-sm-6" wire:model.lazy = "tglKembali">
                                            </address>
                                            @else
                                            <address>
                                                <strong>Rentang Peminjaman :</strong><br>
                                                {{  \Carbon\Carbon::parse($dataSewa->sewa_tglsewa)->format('d, M Y') }} - {{ \Carbon\Carbon::parse($dataSewa->sewa_tglkembali)->format('d, M Y') }} <br>
                                                ({{ $totalHari }} Hari) <br>
                                                Tujuan : {{ $dataSewa->sewa_tujuan }} <br>
                                            </address>
                                            @endif

                                        </div>

                                        <div class="col-sm-6 mt-3 text-sm-right">
                                            <address>
                                                <strong>Tanggal Pembayaran:</strong><br>
                                                {{ \Carbon\Carbon::parse($dataSewa->sewa_tglbayar)->format('d, M Y') }} | {{ \Carbon\Carbon::parse($dataSewa->sewa_tglbayar)->format('H:i') }} WIB<br>
                                            </address>
                                        </div>
                                    </div>

                                    <div class="py-2 mt-3">
                                        <div class="row">
                                            <div class="col-sm-6 mt-4">
                                                <h3 class="font-size-15 font-weight-bold">Detail Sewa</h3>
                                            </div>
                                            @if($dataSewa->sewa_status == 1 or $dataSewa->sewa_status == 7)
                                            <div class="col-sm-6 mt-3">
                                                @if($editPage == true)
                                                <button onclick="return false" wire:click = "edit('{{ false }}')" type="button" class="btn btn-danger  waves-effect waves-light mb-2 pt-2 float-right">Cancel</button>
                                                @else
                                                <button wire:click = "edit('{{ true }}')" type="button" class="btn btn-secondary  waves-effect waves-light mb-2 pt-2 float-right"><i class="fas fa-edit" style="color: white" ></i></button>
                                                @endif
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @if($editPage == true)
                                        @include('livewire.admin.listSewa.fieldAdd.editPage')
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
                                                        <td class="text-right">Rp. {{ $hargaTotal }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" class="text-right">Durasi Peminjaman</td>
                                                        <td class="text-right">{{ $totalHari }} Hari</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" class="border-0 text-right">
                                                            <strong>Total Sewa</strong></td>
                                                        <td class="border-0 text-right"><h4 class="m-0"> Rp. {{ $fullPrice }}  </h4></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="d-print-none">
                                            <div class="float-right">
                                                <a href="{{ url('/list-sewa') }}" class="btn btn-secondary">Kembali</a>&nbsp; &nbsp;&nbsp;

                                                @if($dataSewa->sewa_status == 3)
                                                <a class="btn btn-info"  wire:click="updateStatus" style="color: white">Perbarui Status</a>
                                                @elseif($dataSewa->sewa_status == 4 )
                                                <a class="btn btn-success"  wire:click="updateStatus" style="color: white">Konfirmasi Pengambilan</a>
                                                @else
                                                @endif
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

</div>




