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
                            <h4 class="mb-0 font-size-18">ALAT</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                @if($formAlat)

                    @include('livewire.admin.alat.alatForm')


                @elseif($detailMode)

                    @include('livewire.admin.alat.alatDetail')

                @else

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
                                            <button wire:click="addAlat" type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Tambah Alat</button>
                                        </div>
                                    </div><!-- end col-->
                                </div>
                                <div class="table-responsive"">
                                    <table class="table table-hover mb-0"" style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Alat</th>
                                            <th>Jenis Alat</th>
                                            <th>Merk</th>
                                            <th>Jumlah Stock</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @if ($dataAlat->count() == 0)
                                            <tr>
                                                <td colspan="5" style="text-align: center">Tidak Ada data yang Akan ditampilkan</td>
                                            </tr>
                                        @else
                                            @foreach ($dataAlat as $row)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$row->alat_kode}}</td>
                                                <td>{{$row->jenis_alat->jenis_alat_nama}}</td>
                                                <td>{{$row->merk->merk_nama}}</td>
                                                <td>{{$row->alat_total}}</td>
                                                <td>
                                                    <a wire:click="detailPage('{{ $row->alat_kode }}')" class="btn btn-primary btn-rounded waves-effect waves-light" title="detail"><i class="fas fa-eye" style="color: white"></i></a>
                                                    <a wire:click="editPage('{{ $row->alat_kode }}')" class="btn btn-warning btn-rounded waves-effect waves-light" title="edit"><i class="fas fa-edit" style="color: white"></i></a>
                                                    <a wire:click="deleteAlat('{{ $row->alat_kode }}')" class="btn btn-danger btn-rounded waves-effect waves-light" title="hapus"><i class="fas fa-trash" style="color: white"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

                @endif
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
