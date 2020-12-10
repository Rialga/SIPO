<div>

<livewire:layouts.admin-header />
<livewire:layouts.admin-sidebar />

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12" style="display: flex; justify-content: flex-end">

                    </div>
                </div>
                <!-- end page title -->

                @if($formAlat)

                    @include('livewire.admin.alat.alatForm')


                @elseif($detailMode)

                    @include('livewire.admin.alat.alatDetail')

                @else

                <div class="row">
                    {{-- Button ADD --}}
                    <div class="col-sm-12">
                        <div class="text-sm-right">
                            <button wire:click="add('alat')" type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Tambah Alat</button>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-sm-4 mb-2">
                                        <div class="col form-inline">
                                            <label>Show Page:</label> &nbsp;&nbsp;&nbsp;
                                            <select class="form-control" style="width: 70px" wire:model="showPage">
                                                <option value="2">2</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-8" style="display: flex; justify-content: flex-end">
                                        <div class="search-box mr-5 mb-2 d-inline-block">
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="Search..." wire:model.debounce.300ms="search">
                                                <i class="bx bx-search-alt search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                            <!-- end col-->
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0"" style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th wire:click="sortBy('alat_kode')" style="cursor: pointer;">
                                                Kode Alat
                                                @include('addOn.sort-icon',['field'=>'alat_kode'])
                                            </th>
                                            <th wire:click="sortBy('jenis_alat.jenis_alat_nama')" style="cursor: pointer;">
                                                Jenis Alat
                                                @include('addOn.sort-icon',['field'=>'jenis_alat.jenis_alat_nama'])
                                            </th>
                                            <th wire:click="sortBy('merk.merk_nama')" style="cursor: pointer;">
                                                Merk
                                                @include('addOn.sort-icon',['field'=>'merk.merk_nama'])
                                            </th>
                                            <th wire:click="sortBy('alat_tipe')" style="cursor: pointer;">
                                                Tipe
                                                @include('addOn.sort-icon',['field'=>'alat_tipe'])
                                            </th>
                                            <th wire:click="sortBy('alat_total')" style="cursor: pointer;">
                                                Jumlah Stock
                                                @include('addOn.sort-icon',['field'=>'alat_total'])
                                            </th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @if ($data->count() == 0)
                                            <tr>
                                                <td colspan="5" style="text-align: center">Tidak Ada data yang Akan ditampilkan</td>
                                            </tr>
                                        @else
                                            @foreach ($data as $row)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$row->alat_kode}}</td>
                                                <td>{{$row->jenis_alat->jenis_alat_nama}}</td>
                                                <td>{{$row->merk->merk_nama}}</td>
                                                <td>{{$row->alat_tipe}}</td>
                                                <td>{{$row->alat_total}}</td>
                                                <td>
                                                    <a wire:click="detailPage('{{ $row->alat_kode }}')" class="btn btn-primary btn-rounded waves-effect waves-light" title="detail"><i class="fas fa-eye" style="color: white"></i></a>
                                                    <a wire:click="editPage('{{ $row->alat_kode }}')" class="btn btn-warning btn-rounded waves-effect waves-light" title="edit"><i class="fas fa-edit" style="color: white"></i></a>
                                                    <a class="btn btn-danger btn-rounded waves-effect waves-light" title="hapus"  wire:click="modal('{{ $row->alat_kode }}','alat')"><i class="fas fa-trash" style="color: white"></i></a>

                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                            </div><br>

                            <div class="row justify-content-end">
                                <p class="mb-2 mr-2">
                                    Menampilkan {{ $data->firstItem() }} hingga {{ $data->lastItem() }} dari {{ $data->total() }} item
                                </p>
                            </div>

                            <div class="row mb-0  mr-2">
                                <div class="col-sm-12">
                                    <div class="row justify-content-end">
                                        <p class="mb-2 mr-2">{{ $data->links() }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="modal fade bs-example-modal-center" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="malatdelete">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body" style="text-align: center">
                                    <i class="mdi mdi-alert-circle-outline mb-4 mt-4" style="color: orange; font-size:100px" ></i>
                                    <h4 class="mb-2"> Hapus Data? </h4>
                                    <h6 class="mb-2" muted> Kode Alat : {{ $rowId }} </h6>
                                    <button type="button" class="btn btn-success waves-effect mb-2 mt-2 mr-2" data-dismiss="modal" wire:click="deleteAlat">Hapus</button>
                                    <button type="button" class="btn btn-danger waves-effect mb-2 mt-2 ml-2" data-dismiss="modal">Tidak</button>
                            </div>
                        </div>
                    </div>
                </div>
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


<script>
    window.addEventListener('mAlat', event => {
        $("#malatdelete").modal('show');
    })

</script>

