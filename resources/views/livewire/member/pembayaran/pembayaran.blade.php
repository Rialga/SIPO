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
                                        <h2 class="mb-5">Pembayaran</h2>
                                        <div class="invoice-title">
                                            <h4 class="float-left font-size-20">{{ $dataSewa->sewa_no }}</h4> <br><br>
                                            <h4 class="float-left font-size-15" style="color: orange">( {{ $dataSewa->status_sewa->status_detail }} )</h4>
                                            <a class="btn btn-danger waves-effect waves-light float-right" title="batal" wire:click="batal('{{ $dataSewa->sewa_no }}')"> <h6 style="color: white"> Batal </h6> </a> <br><br>
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

                                                    <strong>Transfer Ke Rek :</strong> <br>
                                                    <img src="{{ asset("storage/bni.png") }}" style="width:  60px; height: 30px;" />
                                                    <strong>0583695906 (Sdr Alex)</strong>
                                                    <hr>
                                                    <strong>Upload Bukti Transfer</strong><br><br><br>
                                                    <div>
                                                        <div wire:loading class="spinner-border text-warning m-1" role="status">
                                                            <span class="sr-only">Loading...</span>
                                                        </div> <br><br>

                                                        <div class="col-sm-5 pl-5">
                                                            <input class="pl-4" name="file[]" type="file" accept='image/*' wire:model="buktiTf">

                                                        </div> <br>
                                                        @error('buktiTf') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror

                                                    </div>
                                                </address>
                                            </div>
                                        </div>
                                        <div class="d-print-none">
                                            <div class="float-right">
                                                <a class="btn btn-secondary" href="{{ url('/sewa') }}">Kembali</a>&nbsp; &nbsp;&nbsp;

                                                @if($buktiTf == null)
                                                <button class="btn btn-warning" onclick="return false" wire:click="bayar('{{ $dataSewa->sewa_no }}')" disabled> Bayar </button>
                                                @else
                                                <button class="btn btn-warning" onclick="return false" wire:click="bayar('{{ $dataSewa->sewa_no }}')"> Bayar </button>
                                                @endif
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
