<div>
<livewire:layouts.header />

<div class="main-content" style="margin: auto;">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="row mb-3">
                        <div class="col-xl-4 col-sm-6">
                            <div class="mt-2">
                                <h5>Perlengkapan Outdoor</h5>
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-6">
                            <form class="mt-4 mt-sm-0 float-sm-right form-inline">
                                <div class="search-box mr-2">
                                    <div class="position-relative">
                                        <input type="text" class="form-control border-0" placeholder="Search...">
                                        <i class="bx bx-search-alt search-icon"></i>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="row">
                        @foreach ($dataAlat as $item)

                        {{-- {{ dd($item->gambar_alat->gambar_file[0]) }} --}}
                        <div class="col-xl-3 col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="product-img position-relative">
                                        <div class="avatar-sm product-ribbon">
                                            <a class="avatar-title rounded-circle  bg-success" style="cursor: pointer;" wire:click="addToCart('{{ $item->alat_kode }}')">
                                                <i class="fas fa-plus" style="color: white"></i>
                                            </a>
                                        </div>
                                        @foreach ($item->gambar_alat as $file)
                                            <a href="#">
                                                <img src="{{ asset("storage/gambarAlat/$file->gambar_file") }}" alt="" class="img-fluid mx-auto d-block" style="object-fit: cover; width:  170px; height: 200px;">
                                            </a>
                                            @break
                                        @endforeach
                                    </div>
                                    <div class="mt-4 text-center">
                                        <h5 class="mb-3 text-truncate"><a href="#" class="text-dark">{{ $item->jenis_alat->jenis_alat_nama }} - {{ $item->merk->merk_nama }}</a></h5>
                                        <h5 class="mb-3 text-truncate"><a href="#" class="text-dark">({{ $item->alat_tipe }})</a></h5>
                                        <h5 class="my-0"><span class="text-muted mr-2"></span> <b>Rp {{ $item->jenis_alat->jenis_alat_harga }} / Hari</b></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="pagination pagination-rounded justify-content-center mt-4">
                                <li class="page-item disabled">
                                    <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">1</a>
                                </li>
                                <li class="page-item active">
                                    <a href="#" class="page-link">2</a>
                                </li>

                                <li class="page-item">
                                    <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                </li>
                            </ul>
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
