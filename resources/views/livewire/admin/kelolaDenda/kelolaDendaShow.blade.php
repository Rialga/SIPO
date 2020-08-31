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
                                <h4 class="mb-0 font-size-18">Kondisi Alat (Denda)</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    @if($formKondisi)

                        @include('livewire.admin.kelolaDenda.kelolaDendaForm')

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
                                                <button wire:click="showFormKondisi" type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Tambah Keterangan Denda</button>
                                            </div>
                                        </div><!-- end col-->
                                    </div>
                                    <div class="table-responsive"">
                                        <table class="table table-hover mb-0"" style="text-align: center">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kondisi Alat</th>
                                                <th>Denda Kerusakan</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @if ($dataKondisi->count() == 0)
                                                <tr>
                                                    <td colspan="5" style="text-align: center">Tidak Ada data yang Akan ditampilkan</td>
                                                </tr>
                                            @else
                                                @foreach ($dataKondisi as $row)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$row->kondisi_keterangan}}</td>
                                                    <td>Rp. {{$row->kondisi_dendarusak}}</td>
                                                    <td>
                                                        <a wire:click="editPage('{{ $row->kondisi_id }}')" class="btn btn-warning btn-rounded waves-effect waves-light" title="edit"><i class="fas fa-edit" style="color: white"></i></a>
                                                        <a wire:click="delete('{{ $row->kondisi_id }}')" class="btn btn-danger btn-rounded waves-effect waves-light" title="hapus"><i class="fas fa-trash" style="color: white"></i></a>
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
