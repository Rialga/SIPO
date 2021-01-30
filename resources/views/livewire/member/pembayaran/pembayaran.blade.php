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
                                            @if($dataSewa->sewa_status == 7)
                                            <h4 class="float-left font-size-15" style="color: red">( {{ $dataSewa->status_sewa->status_detail }} )</h4>
                                            @else
                                            <h4 class="float-left font-size-15" style="color: orange">( {{ $dataSewa->status_sewa->status_detail }} )</h4>
                                            @endif
                                            <a class="btn btn-danger waves-effect waves-light float-right" title="batal" data-toggle="modal" data-target="#batal"> <h6 style="color: white"> Batal </h6> </a> <br><br>
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
                                                                <td>{{ \Carbon\Carbon::parse($dataSewa->sewa_tglsewa)->format('d, M Y') }} - {{ \Carbon\Carbon::parse($dataSewa->sewa_tglkembali)->format('d, M Y') }} ({{ $totalHari }} malam)</td>
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
                                                                    <td style="width:150px""><strong> Total Sewa </strong></td>
                                                                    <td class="text-right"><h4> Rp. {{ number_format($grandTotal) }}</h4></td>
                                                                </tr>
                                                            </table>
                                                        </div>

                                                </address>
                                            </div>
                                            <div class="col-sm-4">
                                                <address>
                                                    <div style="text-align: center">
                                                        <strong>Transfer Ke Rek :</strong>
                                                    </div>

                                                    <div class="text-sm-left">

                                                        <select class="custom-select mt-2" wire:model="rek">
                                                            <option value="">
                                                                <i class="fas fa-credit-card fa-lg mt-3" style="color: rgb(19, 65, 53)"></i>
                                                                - - Pilih Bank --
                                                            </option>
                                                            @foreach ($dataRek as $rek)
                                                            <option value="{{ $rek->rekening_no }}">
                                                                <span> Bank {{ $rek->rekening_bank }}</span><br>
                                                            </option>
                                                            @endforeach
                                                        </select>

                                                        @error('rek') <span class="pt-2 pl-5 mt-3" style="color: red">{{ $message }}</span>  {{$checkKode=false}} <br>@enderror


                                                        @if($bank != null)
                                                        <i class="fas fa-credit-card fa-lg mt-3" style="color: rgb(19, 65, 53)"></i>
                                                        <span> Bank {{ $bank->rekening_bank }}</span><br>
                                                        <span class="ml-4"> {{ $bank->rekening_no }} a.n ({{ $bank->rekening_an }})</span> <br>
                                                        @endif
                                                    </div>

                                                    <hr>
                                                    <div class="mb-5" style="text-align: center">
                                                        <strong>Upload Bukti Transfer</strong>
                                                    </div>

                                                    <div>
                                                        <div class="ml-5">
                                                            <div wire:loading  class="spinner-border text-warning m-1  ml-5" role="status">
                                                                <span class="sr-only">Loading...</span>
                                                            </div>
                                                        </div>
                                                        <div class="ml-5">
                                                            <image src="" alt="Image Preview"  id="img" width="100" height="100" style="display: none">
                                                        </div>
                                                        <br><br>

                                                        <div class="col-sm-5 pl-5">
                                                            <input class="pl-4" name="file[]" type="file" accept='image/*' wire:model="buktiTf"  onChange="readURL(this);">
                                                        </div> <br>
                                                        @error('buktiTf') <span class="pt-2 pl-5" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror

                                                    </div>
                                                </address>
                                            </div>

                                            <div class="modal fade bs-example-modal-center" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="batal">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body" style="text-align: center">
                                                                <i class="mdi mdi-alert-circle-outline mb-4 mt-4" style="color: orange; font-size:100px" ></i>
                                                                <h4 class="mb-4"> Batalkan Penyewaan? </h4>
                                                                <button class="btn btn-success mb-2 mt-2 mr-2" onclick="return false" wire:click="batal('{{ $dataSewa->sewa_no }}')" data-dismiss="modal">Ya</button>
                                                                <button type="button" class="btn btn-danger waves-effect mb-2 mt-2 ml-2" data-dismiss="modal">Tidak</button>
                                                        </div>
                                                    </div>
                                                </div>
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


