<div>

    <livewire:layouts.header />

    <div class="main-content" style="margin: auto;">
        <div class="page-content">
            <div class="container-fluid">

                <div class="row">

                    <livewire:layouts.sidebar />

                    <div class="col-lg-9">
                        @if($data->count() == 0)
                        <div class="card">
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <h2 class="mb-5">Cart</h2>

                                    <br>
                                    <h3 class="mb-5" style="text-align: center">
                                        <i style="color: gray" class="bx bx-cart"></i>
                                        <i style="color: gray">Cart Anda Kosong...</i> <br><br>

                                            <a href="{{ url('/') }}" class="btn btn-success">
                                                <i class="mdi mdi-arrow-left mr-1"></i> Pilih Alat
                                            </a>

                                    </h3>
                                    <br>
                                </div>
                            </div>
                        </div>
                        @else

                        <div class="row">
                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="mb-4">Cart</h2> <br>

                                        <div class="form-group row text-sm-center">
                                            <div class="col-sm-6">
                                                <span class="card-title ">Tanggal Pinjam </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <span class="card-title ">Tanggal Kembali </span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input disabled type="date" class="form-control" wire:model.lazy="tglPinjam" id="tglPinjam" name="tglPinjam">
                                                    <label class="control-label pt-2"> &nbsp; -  &nbsp;</label>
                                                    <input disabled type="date" class="form-control" wire:model.lazy="tglKembali" id="tglKembali" name="tglKembali">
                                                </div>
                                                <br>
                                                @error('tglPinjam') <span style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror<br>
                                                @error('tglKembali') <span style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                            </div>
                                        </div>

                                        <h4 class="card-title mb-2 text-center">Tujuan Sewa</h4>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" wire:model.lazy="sewaTujuan" id="sewaTujuan" name="sewaTujuan">
                                                </div>
                                                <br>
                                                @error('sewaTujuan') <span style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror<br>
                                            </div>
                                        </div>


                                        <div class="table-responsive">
                                            <table class="table table-centered ">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Alat</th>
                                                        <th>Deskripsi Alat</th>
                                                        <th style="text-align: center;">Harga</th>
                                                        <th style="text-align: center;">Jumlah</th>
                                                        <th style="text-align: center;">Total</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($data->sortBy('id') as $key =>$item)
                                                    @if($stokNow[$item->id] <= 0)
                                                     <input hidden type="text" value="{{ $button = 'disabled' }}">
                                                    <tr>
                                                        <td style="opacity: 0.5;">
                                                            <img src={{ asset("storage/gambarAlat/".$item->attributes->pic) }} class="avatar-md" />

                                                        </td>
                                                        <td style="opacity: 0.5;">
                                                            <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark">{{ $item->name}}</a></h5>
                                                            <p class="mb-0">Merk : <span class="font-weight-medium">{{ $item->attributes->merk }}</span></p>
                                                            <p class="mb-0">Tipe : <span class="font-weight-medium">{{ $item->attributes->type }}</span></p>
                                                        </td>
                                                        <td style="text-align: center; opacity: 0.5;">
                                                            Rp. {{ $harga[$key] }}
                                                        </td>
                                                        <td style="text-align: center; opacity: 0.5;">
                                                           <span style="color: red"> Stok Tidak Tersedia !<br> Ganti Alat atau Tanggal Penyewaan </span>
                                                        </td>
                                                        <td style="text-align: center; opacity: 0.5;">
                                                            Rp. {{ number_format($harga[$key] * $item->quantity)}}
                                                        </td>
                                                        <td>
                                                            <a wire:click="modal('{{ $item->id }}')"class="action-icon text-danger"> <i class="mdi mdi-trash-can font-size-18" style="cursor: pointer;"></i></a>

                                                        </td>
                                                    </tr>
                                                    @elseif($stokNow[$item->id] <  $item->quantity)
                                                    <input hidden type="text" value="{{ $button = 'disabled' }}">
                                                    <tr>
                                                        <td>
                                                            <img src={{ asset("storage/gambarAlat/".$item->attributes->pic) }} class="avatar-md" />

                                                        </td>
                                                        <td>
                                                            <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark">{{ $item->name}}</a></h5>
                                                            <p class="mb-0">Merk : <span class="font-weight-medium">{{ $item->attributes->merk }}</span></p>
                                                            <p class="mb-0">Tipe : <span class="font-weight-medium">{{ $item->attributes->type }}</span></p>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            Rp. {{ $harga[$key] }}
                                                        </td>
                                                        <td>
                                                            <div class="row ml-2">
                                                                <div wire:loading wire:target="removeqty" class="spinner-border text-warning" role="status">
                                                                    <span class="sr-only">Loading...</span>
                                                                </div>

                                                                <a wire:loading.remove wire:click="removeqty('{{ $item->id }}')" class="btn btn-danger" > <i class="fa fa-minus" style="cursor: pointer; color:white"></i></a>

                                                                <input disabled type="number" class="form-control col-sm-5 text-center"  min="0" wire:model.lazy = "stok.{{ $item->id }}" />

                                                                <a wire:loading.remove wire:click="addqty('{{ $item->id }}')" class="btn btn-success " > <i class="fa fa-plus" style="cursor: pointer; color:white"></i></a>

                                                                <div wire:loading wire:target="addqty" class="spinner-border text-warning" role="status">
                                                                    <span class="sr-only">Loading...</span>
                                                                </div>

                                                            </div>
                                                             @error('stok.*') <span style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                                             <span style="color: red">Stok yang tersedia hanya : {{ $stokNow[$item->id] }} </span>

                                                        </td>
                                                        <td style="text-align: center;">
                                                            Rp. {{ number_format($harga[$key] * $item->quantity)}}
                                                        </td>
                                                        <td>
                                                            <a wire:click="modal('{{ $item->id }}')"class="action-icon text-danger"> <i class="mdi mdi-trash-can font-size-18" style="cursor: pointer;"></i></a>

                                                        </td>
                                                    </tr>
                                                    @else
                                                    <tr>
                                                        <td>
                                                            <img src={{ asset("storage/gambarAlat/".$item->attributes->pic) }} class="avatar-md" />

                                                        </td>
                                                        <td>
                                                            <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark">{{ $item->name}}</a></h5>
                                                            <p class="mb-0">Merk : <span class="font-weight-medium">{{ $item->attributes->merk }}</span></p>
                                                            <p class="mb-0">Tipe : <span class="font-weight-medium">{{ $item->attributes->type }}</span></p>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            Rp. {{ $harga[$key] }}
                                                        </td>
                                                        <td>
                                                            <div class="row ml-2">
                                                                <div wire:loading wire:target="removeqty" class="spinner-border text-warning" role="status">
                                                                    <span class="sr-only">Loading...</span>
                                                                </div>

                                                                <a wire:loading.remove wire:click="removeqty('{{ $item->id }}')" class="btn btn-danger" > <i class="fa fa-minus" style="cursor: pointer; color:white"></i></a>

                                                                <input disabled type="number" class="form-control col-sm-5 text-center"  min="0" wire:model.lazy = "stok.{{ $item->id }}" />

                                                                <a wire:loading.remove wire:click="addqty('{{ $item->id }}')" class="btn btn-success " > <i class="fa fa-plus" style="cursor: pointer; color:white"></i></a>

                                                                <div wire:loading wire:target="addqty" class="spinner-border text-warning" role="status">
                                                                    <span class="sr-only">Loading...</span>
                                                                </div>

                                                            </div>
                                                             @error('stok.*') <span style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror

                                                        </td>
                                                        <td style="text-align: center;">
                                                            Rp. {{ number_format($harga[$key] * $item->quantity)}}
                                                        </td>
                                                        <td>
                                                            <a wire:click="modal('{{ $item->id }}')"class="action-icon text-danger"> <i class="mdi mdi-trash-can font-size-18" style="cursor: pointer;"></i></a>

                                                        </td>
                                                    </tr>
                                                    @endif

                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-sm-6">
                                                <a href="{{ url('/') }}" class="btn btn-secondary">
                                                    <i class="mdi mdi-arrow-left mr-1"></i> Pilih Lagi </a>
                                            </div> <!-- end col -->
                                            <div class="col-sm-6">
                                                <div class="text-sm-right mt-2 mt-sm-0">
                                                    <button {{ $button }} wire:click="checkout" class="btn btn-success" style="color: white">
                                                        <i class="mdi mdi-cart-arrow-right mr-1"></i> Buat Penyewaan </button>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                 <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title mb-3">Rangkuman Penyewaan</h4>

                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>Estimasi Penyewaan : </td>
                                                        <td> {{ $estimasi }} Malam</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total :</th>
                                                        <th>Rp.{{ number_format($sumHarga) }}</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <div class="modal fade bs-example-modal-center" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mcartdelete">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body" style="text-align: center">
                                                <i class="mdi mdi-alert-circle-outline mb-4 mt-4" style="color: orange; font-size:100px" ></i>
                                                <h4 class="mb-2"> Hapus Data? </h4>
                                                <h6 class="mb-2" muted> Alat Kode : {{ $rowId }} </h6>
                                                <button type="button" class="btn btn-success waves-effect mb-2 mt-2 mr-2" data-dismiss="modal" wire:click="remove">Hapus</button>
                                                <button type="button" class="btn btn-danger waves-effect mb-2 mt-2 ml-2" data-dismiss="modal">Tidak</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endif
                        </div>



                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <livewire:layouts.footer />
    </div>


    </div>

    <script>
        window.addEventListener('mCart', event => {
            $("#mcartdelete").modal('show');
        })

    </script>
