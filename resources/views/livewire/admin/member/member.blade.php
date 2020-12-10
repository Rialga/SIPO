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
                                <h4 class="mb-0 font-size-18">Member</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    @if($formMember)

                        @include('livewire.admin.member.memberForm')


                    @else



                    <div class="row">

                        {{-- Button ADD --}}
                        <div class="col-sm-12">
                            <div class="text-sm-right">
                                <button wire:click="showFormMember" type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Tambah Member</button>
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

                                    <div class="table-responsive"">
                                        <table class="table table-hover mb-0"" style="text-align: center">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th wire:click="sortBy('user_id')" style="cursor: pointer;">
                                                    Member ID
                                                    @include('addOn.sort-icon',['field'=>'user_id'])
                                                </th>
                                                <th wire:click="sortBy('user_nama')" style="cursor: pointer;">
                                                    Member Nama
                                                    @include('addOn.sort-icon',['field'=>'user_nama'])
                                                </th>
                                                <th wire:click="sortBy('user_mail')" style="cursor: pointer;">
                                                    Member Email
                                                    @include('addOn.sort-icon',['field'=>'user_mail'])
                                                </th>
                                                <th wire:click="sortBy('user_phone')" style="cursor: pointer;">
                                                    Member HP
                                                    @include('addOn.sort-icon',['field'=>'user_phone'])
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
                                                    <td class="btn waves-effect waves-light" wire:click="showDetailPage('{{ $row->user_id }}')" >{{$row->user_nick}}</td>
                                                    <td>{{$row->user_nama}}</td>
                                                    <td>{{$row->user_mail}}</td>
                                                    <td>{{$row->user_phone}}</td>
                                                    <td>
                                                        <a wire:click="showDetailPage('{{ $row->user_id }}')" class="btn btn-info btn-rounded waves-effect waves-light" title="edit"><i class="fas fa-eye" style="color: white"></i></a>
                                                        <a wire:click="modal('{{ $row->user_id }}')" class="btn btn-danger btn-rounded waves-effect waves-light" title="hapus"><i class="fas fa-trash" style="color: white"></i></a>
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
                                                <p class="mb-2 mr-2"> {{ $data->links() }} </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <div class="modal fade bs-example-modal-center" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mpenyewadelete">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body" style="text-align: center">
                                        <i class="mdi mdi-alert-circle-outline mb-4 mt-4" style="color: orange; font-size:100px" ></i>
                                        <h4 class="mb-2"> Hapus Data? </h4>
                                        <h6 class="mb-2" muted> Penyewa ID : {{ $rowId }} </h6>
                                        <button type="button" class="btn btn-success waves-effect mb-2 mt-2 mr-2" data-dismiss="modal" wire:click="delete">Hapus</button>
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
        window.addEventListener('mPenyewa', event => {
            $("#mpenyewadelete").modal('show');
        })

    </script>
