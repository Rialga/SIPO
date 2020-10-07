<div>
    <livewire:layouts.header />

    <div class="main-content" style="margin: auto;">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="page-title-box d-flex align-items-center justify-content-between">
                                            <h4 class="mb-0 font-size-18">Produk Detail</h4>

                                            <div class="page-title-right">
                                                <ol class="breadcrumb m-0">
                                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Produk Lis</a></li>
                                                    <li class="breadcrumb-item active">Produk Detail</li>
                                                </ol>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="product-detai-imgs">
                                            <div class="row">
                                                <div class="col-md-2 col-sm-3 col-4">
                                                    <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">

                                                        @foreach($dataAlat->gambar_alat as $item)
                                                            <input hidden id="{{ $idDiv++ }}">
                                                            <a class="nav-link " id="product-{{ $idDiv }}-tab" data-toggle="pill" href="#product-{{ $idDiv }}" role="tab" aria-controls="product-{{ $idDiv }}" aria-selected="false">
                                                                <img src="{{ asset("storage/gambarAlat/".$item->gambar_file) }}" alt="" class="img-fluid mx-auto d-block rounded">
                                                            </a>
                                                        @endforeach

                                                    </div>
                                                </div>
                                                <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                                    <div class="tab-content" id="v-pills-tabContent">
                                                        <div class="tab-pane fade show active " id="product-{{ $idPic }}" role="tabpanel" aria-labelledby="product-{{ $idPic }}-tab">
                                                            <div>
                                                                <img src="{{ asset("storage/gambarAlat/".$dataAlat->gambar_alat[0]->gambar_file) }}" alt="" class="img-fluid mx-auto d-block" style="object-fit: cover; width:  170px; height: 200px;">
                                                            </div>
                                                        </div>

                                                        @foreach ($dataAlat->gambar_alat as $item)
                                                            <input hidden id="{{ $idPic++ }}">
                                                            <div class="tab-pane fade show " id="product-{{ $idPic }}" role="tabpanel" aria-labelledby="product-{{ $idPic }}-tab">
                                                                <div>
                                                                    <img src="{{ asset("storage/gambarAlat/".$item->gambar_file) }}" alt="" class="img-fluid mx-auto d-block" style="object-fit: cover; width:  170px; height: 200px;">
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                    <div class="text-center mt-5 mt-xl-5">

                                                        @guest
                                                        <a href="{{ url('/login') }}" class="btn btn-primary waves-effect waves-light mt-2 mr-1">
                                                            <i class="bx bx-cart mr-2"></i> Add to cart
                                                        </a>

                                                        @endguest
                                                        @auth
                                                        <button type="button" class="btn btn-primary waves-effect waves-light mt-2 mr-1" wire:click="addToCart('{{ $dataAlat->alat_kode }}')">
                                                            <i class="bx bx-cart mr-2"></i> Add to cart
                                                        </button>
                                                        @endauth
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mt-4 mt-xl-4">

                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">

                                                    <tr>
                                                        <td colspan="3"><h2 style="color: #0D6EC6">{{ $dataAlat->jenis_alat->jenis_alat_nama }}</h4</td>
                                                    </tr>

                                                    <tr>
                                                        <td style="width:80px; font-size: 15px">Merk</td>
                                                        <td style="width:80px;">:</td>
                                                        <td><h4>{{ $dataAlat->merk->merk_nama }}</h4> </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 15px">Tipe</td>
                                                        <td>:</td>
                                                        <td> <h4>{{ $dataAlat->alat_tipe }}</h4></td>
                                                    </tr>

                                                    <td colspan="3" style="text-align: left">( {{ $dataAlat->alat_total }} stok tersedia )</td>

                                                    <tr >
                                                        <td colspan="3" style="text-align: right">
                                                           <p style="font-size: 15px"> Harga :  <b style="color: orangered;font-size: 20px">Rp {{ $dataAlat->jenis_alat->jenis_alat_harga }}</b> / Hari </p>
                                                        </td>
                                                    </tr>

                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                </div>
            </div>
        </div>

        <livewire:layouts.footer />

    </div>

</div>
