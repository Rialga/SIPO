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
                                <div class="col-xl-4 col-sm-6">
                                    <div class="mt-2">
                                        <h5>{{ $header }}</h5>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-sm-6">
                                    <form class="mt-4 mt-sm-0 float-sm-right form-inline">
                                        <div class="search-box mr-2">
                                            <div class="position-relative">
                                                <input wire:model.debounce.300ms="search" type="text" class="form-control border-0" placeholder="Search...">
                                                <i class="bx bx-search-alt search-icon"></i>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <div class="row tab-pane fade show active" role="tabpanel">
                                @foreach ($dataAlat as $key =>$data)
                                <div class="col-sm-3">
                                    <div class="card">
                                        @if($data->alat_total < 1)
                                            <div class="card-body" style="opacity:0.3;">
                                        @else
                                            <div class="card-body">
                                        @endif
                                                <div class="mt-2 text-center">
                                                    <h5 class="mb-3 text-truncate"><a href="{{ url('/produk/'.$data->alat_kode) }}" class="text-dark">{{ $data->jenis_alat->jenis_alat_nama }}</a></h5>
                                                    <h5 class="mb-3 text-truncate"><a href="{{ url('/produk/'.$data->alat_kode) }}" class="text-dark"><b>{{ $data->merk->merk_nama }}</b></a></h5>
                                                </div>
                                                <div class="product-img position-relative">
                                                @if($data->alat_total > 0)
                                                    <a href="{{ url('/produk/'.$data->alat_kode) }}">

                                                @else
                                                    <a>
                                                @endif
                                                        <img src="{{ asset("storage/gambarAlat/".$data->gambar_alat[0]->gambar_file) }}" alt="" class="img-fluid mx-auto d-block" style=" height: 100px;">
                                                    </a>
                                                </div>
                                            @if($data->alat_total > 0)
                                               <div class="mt-4 text-center">
                                                    <h5 class="mb-3 text-truncate"><a href="{{ url('/produk/'.$data->alat_kode) }}" class="text-dark">{{ $data->alat_tipe }} </a></h5>
                                                    <h5 class="mb-3 text-truncate"><a href="{{ url('/produk/'.$data->alat_kode) }}" class="text-dark">stok : {{ $data->alat_total }} </a></h5>
                                                    <h5 class="my-0" style="color: #2bbd3c"><span class="text-muted mr-2"></span> <b>Rp {{ $data->jenis_alat->jenis_alat_harga }} / Hari</b></h5>
                                                    
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
                                            @else
                                                <div class="mt-4 text-center">
                                                    <h5 class="mb-3 text-truncate"><a class="text-dark">{{ $data->alat_tipe }}</a></h5>
                                                    <h5 class="mb-3 text-truncate"><a href="{{ url('/produk/'.$data->alat_kode) }}" class="text-dark">stok : {{ $data->alat_total }} </a></h5>
                                                    <h5 class="my-0" style="color: #2bbd3c"><span class="text-muted mr-2"></span> <b>Rp {{ $data->jenis_alat->jenis_alat_harga }} / Hari</b></h5>
                                                    <a class="btn btn-danger  mt-4 mr-1" style=" cursor: not-allowed;pointer-events: all"> <span style="color: white">Stok Tidak Tersedia</span> </a>
                                                </div>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                            </div>


                        </div>

                    </div>


        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <livewire:layouts.footer />
</div>

</div>
