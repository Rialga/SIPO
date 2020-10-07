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

                                    <br><br><br><br><br>
                                    <h3 class="mb-5" style="text-align: center">
                                        <i style="color: gray" class="bx bx-cart"></i>
                                        <i style="color: gray">Cart Anda Kosong...</i> <br><br>

                                            <a href="{{ url('/') }}" class="btn btn-success">
                                                <i class="mdi mdi-arrow-left mr-1"></i> Pilih Alat
                                            </a>

                                    </h3>
                                    <br><br><br><br><br><br>

                                </div>
                            </div>
                        </div>
                        @else

                        <div class="row">
                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="mb-4">Cart</h2> <br>

                                        <h4 class="card-title mb-3">Tanggal Penyewaan</h4>
                                        <div class="form-group row">
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="date" class="form-control" wire:model.lazy="tglPinjam" id="tglPinjam" name="tglPinjam">
                                                    <label class="control-label pt-2"> &nbsp; -  &nbsp;</label>
                                                    <input type="date" class="form-control" wire:model.lazy="tglKembali" id="tglKembali" name="tglKembali">
                                                </div>
                                                <br>
                                                @error('tglPinjam') <span style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror<br>
                                                @error('tglKembali') <span style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                            </div>
                                        </div>

                                        <h4 class="card-title mb-2">Tujuan Sewa</h4>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" wire:model.lazy="sewaTujuan" id="sewaTujuan" name="sewaTujuan">
                                                </div>
                                                <br>
                                                @error('sewaTujuan') <span style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror<br>
                                            </div>
                                        </div>


                                        <div class="table-responsive">
                                            <table class="table table-centered mb-0 table-nowrap">
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
                                                @foreach ($data->sortBy('id') as $item)

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
                                                        Rp. {{ $item->price }}
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <div>
                                                            <input type="number" class="col-sm-7" wire:model.lazy = "stok.{{ $item->id }}" />
                                                            <a wire:click="addCart('{{ $item->id }}')" class="action-icon text-warning pt-3"> <i class="far fa-edit font-size-18" style="cursor: pointer;"></i></a>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        Rp. {{ number_format($item->price * $item->quantity)}}
                                                    </td>
                                                    <td>
                                                        <a wire:click="remove('{{ $item->id }}')" class="action-icon text-danger"> <i class="mdi mdi-trash-can font-size-18" style="cursor: pointer;"></i></a>
                                                    </td>
                                                </tr>
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
                                                    <a wire:click="checkout" class="btn btn-success" style="color: white">
                                                        <i class="mdi mdi-cart-arrow-right mr-1"></i> Checkout </a>
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
                                                        <td>Total Sewa Alat :</td>
                                                        <td>Rp. {{ $sumHarga }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Estimasi Penyewaan : </td>
                                                        <td> {{  \Carbon\Carbon::parse( $tglPinjam )->diffInDays( $tglKembali )}} Hari</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total :</th>
                                                        <th>Rp. {{ number_format( \Carbon\Carbon::parse( $tglPinjam )->diffInDays( $tglKembali ) * $sumHarga )}}</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                </div>
                                <!-- end card -->
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
