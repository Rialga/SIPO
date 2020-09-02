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
                                <h4 class="mb-0 font-size-18">Sewat</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    {{-- @if($formJenis)

                        @include('livewire.admin.jenis.jenisForm')

                    @else --}}

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-sm-4">
                                            <div class="search-box mr-2 mb-2 d-inline-block">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Search...">
                                                    <i class="bx bx-search-alt search-icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="text-sm-right">
                                                {{-- <button wire:click="showFormJenis" type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Tambah Jenis Alat</button> --}}
                                            </div>
                                        </div><!-- end col-->
                                    </div>
                                    <div class="table-responsive"">
                                        <table class="table table-hover mb-0"" style="text-align: center">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Alat</th>
                                                <th>Harga</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            {{-- @if ($dataJenis->count() == 0) --}}
                                                <tr>
                                                    <td colspan="5" style="text-align: center">Tidak Ada data yang Akan ditampilkan</td>
                                                </tr>
                                            {{-- @else --}}
                                                {{-- @foreach ($dataJenis as $row) --}}
                                                {{-- <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$row->jenis_alat_nama}}</td>
                                                    <td>Rp. {{$row->jenis_alat_harga}}</td>
                                                    <td>
                                                        <a wire:click="editPage('{{ $row->jenis_alat_id }}')" class="btn btn-warning btn-rounded waves-effect waves-light" title="edit"><i class="fas fa-edit" style="color: white"></i></a>
                                                        <a wire:click="delete('{{ $row->jenis_alat_id }}')" class="btn btn-danger btn-rounded waves-effect waves-light" title="hapus"><i class="fas fa-trash" style="color: white"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach --}}
                                            {{-- @endif --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    {{-- @endif --}}
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


    <script type="text/javascript">


    </script>
