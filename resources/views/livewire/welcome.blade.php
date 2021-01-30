<div>
<livewire:layouts.header />

<div class="main-content" style="margin: auto;">

    <div class="page-content">
        <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-2">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Pilih Jenis: </h4>

                                    <div>
                                        <ul class="list-unstyled product-list nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <li><a wire:click="filter('')" class="nav-link mb-2" id="v-pills-0-tab" data-toggle="pill" href="#v-pills-0" role="tab" aria-controls="v-pills-0" aria-selected="true" ><i class="mdi mdi-chevron-right mr-1"></i> Semua Jenis</a></li>
                                            @foreach ($dataJenis as $key =>$item)
                                            <li><a wire:click="filter('{{ $item->jenis_alat_nama }}')" class="nav-link mb-2" id="v-pills-{{ $loop->iteration }}-tab" data-toggle="pill" href="#v-pills-{{ $loop->iteration }}" role="tab" aria-controls="v-pills-{{ $loop->iteration }}" aria-selected="true" ><i class="mdi mdi-chevron-right mr-1"></i> {{ $item->jenis_alat_nama }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-10" >

                            <div class="row mb-3">
                                <div class="col-xl-8">
                                    <div class="mt-2">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input wire:model.lazy="tglPinjam" type="text" class="form-control border-1" placeholder="Tanggal Pinjam" onfocus="(this.type='date')" onblur="(this.type='text')">
                                                    <label class="control-label pt-2"> &nbsp; -  &nbsp;</label>
                                                    <input wire:model.lazy="tglKembali" type="text" class="form-control border-1 mr-2" placeholder="Tanggal Kembali" onfocus="(this.type='date')" onblur="(this.type='text')">
                                                    <button wire:click="filtertotal" type="button" class="btn btn-info waves-effect waves-light"><i class="bx bx-search-alt"></i></button>

                                                    <div wire:loading class="spinner-border text-warning" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                @error('tglPinjam') <span style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                @error('tglKembali') <span style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <form class="mt-4 mt-sm-0 float-sm-right form-inline">
                                        <div class="search-box mr-2">
                                            <div class="position-relative">
                                                <input wire:model.debounce.300ms="search" type="text" class="form-control border-0" placeholder="Cari...">
                                                <i class="bx bx-search-alt search-icon"></i>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-xl-12">
                                    <div class="mt-2">
                                        <h5>{{ $header }}</h5>
                                    </div>
                                </div>
                            </div>

                            @if($alatMode == false)
                                <div class="row tab-pane fade show active" role="tabpanel">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-body mt-5 mb-5">
                                                <div class="mt-5 mb-5 text-center">

                                                    <img class="mb-5" src={{ asset("assets/images/logo-dark.png")}} alt="" height="100">

                                                    <h4 style="color: grey"> Inputkan <b style="color: rgb(8, 110, 206)">Tanggal Peminjaman</b> dan</h4>
                                                    <h4 style="color: grey"> <b style="color: rgb(8, 110, 206)">Tanggal Pengembalian</b> terlebih dahulu! </h4>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row tab-pane fade show active" role="tabpanel">
                                    @foreach ($dataAlat as $key =>$data)
                                        <div class="col-sm-3">
                                            <div class="card">

                                                @if($stokNow[$data->alat_kode] < 1)
                                                    <div class="card-body" style="opacity:0.3;">
                                                        <div class="mt-2 text-center">
                                                            <h5 class="mb-3 text-truncate"><a class="text-dark">{{ $data->jenis_alat->jenis_alat_nama }}</a></h5>
                                                            <h5 class="mb-3 text-truncate"><a class="text-dark"><b>{{ $data->merk->merk_nama }}</b></a></h5>
                                                        </div>
                                                        <div class="product-img position-relative">
                                                            <a><img src="{{ asset("storage/gambarAlat/".$data->gambar_alat[0]->gambar_file) }}" alt="" class="img-fluid mx-auto d-block" style=" height: 100px;"></a>

                                                            <div class="mt-4 text-center">
                                                                <h5 class="mb-3 text-truncate"><a class="text-dark">{{ $data->alat_tipe }}</a></h5>
                                                                @if($stokNow[$data->alat_kode] < 0)
                                                                <h5 class="mb-3 text-truncate"><a class="text-dark">stok : 0 </a></h5>
                                                                @else
                                                                <h5 class="mb-3 text-truncate"><a class="text-dark">stok : {{ $stokNow[$data->alat_kode] }} </a></h5>
                                                                @endif
                                                                <h5 class="my-0" style="color: #2bbd3c"><span class="text-muted mr-2"></span> <b>Rp {{ $data->jenis_alat->jenis_alat_harga1 }} / Malam</b></h5>
                                                                <a class="btn btn-danger  mt-4 mr-1" style=" cursor: not-allowed;pointer-events: all"> <span style="color: white">Stok Tidak Tersedia</span> </a>
                                                            </div>

                                                        </div>
                                                    </div>

                                                @else
                                                    <div class="card-body">

                                                        <div class="mt-2 text-center">
                                                            <h5 class="mb-3 text-truncate"><a href="{{ url('/produk/'.$data->alat_kode) }}" class="text-dark">{{ $data->jenis_alat->jenis_alat_nama }}</a></h5>
                                                            <h5 class="mb-3 text-truncate"><a href="{{ url('/produk/'.$data->alat_kode) }}" class="text-dark"><b>{{ $data->merk->merk_nama }}</b></a></h5>
                                                        </div>
                                                        <div class="product-img position-relative">
                                                            <a href="{{ url('/produk/'.$data->alat_kode) }}">
                                                                @if($data->gambar_alat->count() == 0 )
                                                                <img src="" alt="" class="img-fluid mx-auto d-block" style=" height: 100px;">
                                                                @else
                                                                <img src="{{ asset("storage/gambarAlat/".$data->gambar_alat[0]->gambar_file) }}" alt="" class="img-fluid mx-auto d-block" style=" height: 100px;">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="mt-4 text-center">
                                                            <h5 class="mb-3 text-truncate"><a href="{{ url('/produk/'.$data->alat_kode) }}" class="text-dark">{{ $data->alat_tipe }} </a></h5>
                                                            <h5 class="mb-3 text-truncate"><a href="{{ url('/produk/'.$data->alat_kode) }}" class="text-dark">stok : {{ $stokNow[$data->alat_kode] }} </a></h5>
                                                            <h5 class="my-0" style="color: #2bbd3c"><span class="text-muted mr-2"></span> <b>Rp {{ $data->jenis_alat->jenis_alat_harga1}} / Malam</b></h5>

                                                            @guest
                                                            <a href="{{ url('/login') }}" class="btn btn-primary waves-effect waves-light mt-4 mr-1">
                                                                <i class="bx bx-cart mr-2"></i> Add to cart
                                                            </a>

                                                            @endguest
                                                            @auth
                                                            <button {{$button[$data->alat_kode]}} type="button" class="btn btn-primary waves-effect waves-light mt-4 mr-1" wire:click="addToCart('{{ $data->alat_kode }}')">
                                                                + Keranjang <i class="bx bx-cart mr-2"></i>
                                                            </button>
                                                            @endauth

                                                        </div>

                                                    </div>

                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="modal fade bs-example-modal-center" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mvalidasi">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body" style="text-align: center">
                                                <i class="mdi mdi-alert-circle-outline mb-4 mt-4" style="color: orange; font-size:100px" ></i>
                                                <h4 class="mb-4"> Masukkan Rentang Waktu dengan Benar !</h4>
                                                <button type="button" class="btn btn-secondary waves-effect mb-2 mt-2 ml-2" data-dismiss="modal">close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <livewire:layouts.footer />
</div>

</div>

<script>
    window.addEventListener('validasi', event => {
        $("#mvalidasi").modal('show');
    })

</script>
