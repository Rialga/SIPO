<div>

    <livewire:layouts.header />

    <div class="main-content" style="margin: auto;">
        <div class="page-content">
            <div class="container-fluid">

                <div class="row">

                    <livewire:layouts.sidebar />

                    <div class="col-lg-9">

                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Cart</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title mb-4">Tanggal Penyewaan</h4>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input type="date" class="form-control" wire:model.lazy="tglPinjam" id="tglPinjam" name="tglPinjam">
                                                    <label class="control-label pt-2"> &nbsp; -  &nbsp;</label>
                                                    <input type="date" class="form-control" wire:model.lazy="tglKembali" id="tglKembali" name="tglKembali">
                                                </div>
                                                <br>
                                                @error('tglPinjam') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror<br>
                                                @error('tglKembali') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                            </div>
                                        </div>




                                        <div class="table-responsive">
                                            <table class="table table-centered mb-0 table-nowrap">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Alat</th>
                                                        <th>Deskripsi Alat</th>
                                                        <th>Harga</th>
                                                        <th>Jumlah</th>
                                                        <th colspan="2">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($dataAlat as $item)
                                                <tr>
                                                    <td>
                                                        <img src={{ asset("storage/gambarAlat/$item->gambar_file") }} class="avatar-md" />
                                                    </td>
                                                    <td>
                                                        <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark">{{ $item->jenis_alat->jenis_alat_nama }}</a></h5>
                                                        <p class="mb-0">Merk : <span class="font-weight-medium">{{ $item->merk->merk_nama }}</span></p>
                                                        <p class="mb-0">Tipe : <span class="font-weight-medium">{{ $item->alat_tipe }}</span></p>
                                                    </td>
                                                    <td>
                                                        {{ $item->jenis_alat->jenis_alat_harga }}
                                                    </td>
                                                    <td>
                                                        <input class="form-control col-sm-4" type="number" wire:model.lazy = "total" >
                                                    </td>

                                                    <td>
                                                        <a wire:click="remove('{{ $item->alat_kode }}')" class="action-icon text-danger"> <i class="mdi mdi-trash-can font-size-18"></i></a>
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
                                                    <a href="ecommerce-checkout.html" class="btn btn-success">
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
                                                        <td>$ 1,857</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Estimasi Penyewaan : </td>
                                                        <td> 2 Hari</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total :</th>
                                                        <th>$ 1744.22</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <livewire:layouts.footer />
    </div>


    </div>
