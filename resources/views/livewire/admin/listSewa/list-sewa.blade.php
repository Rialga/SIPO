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
                                <h4 class="mb-0 font-size-18">Sewa</h4>

                                <h4 wire:loading> Loading . . . </h4>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    @if($formSewa)

                         @include('livewire.admin.listSewa.sewaForm')

                    @else

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="text-sm-right">
                                <button wire:click="showFormSewa" type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Tambah Sewa</button>
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
                                                <th wire:click="sortBy('sewa_no')" style="cursor: pointer;">
                                                    No Invoice
                                                    @include('addOn.sort-icon',['field'=>'sewa_no'])
                                                </th>
                                                <th wire:click="sortBy('user.user_nama')" style="cursor: pointer;">
                                                    Nama Penyewa
                                                    @include('addOn.sort-icon',['field'=>'user.user_nama'])
                                                </th>
                                                <th wire:click="sortBy('sewa_tglsewa')" style="cursor: pointer;">
                                                    Tanggal Pinjam
                                                    @include('addOn.sort-icon',['field'=>'sewa_tglsewa'])
                                                </th>
                                                <th wire:click="sortBy('sewa_tglkembali')" style="cursor: pointer;">
                                                    Tanggal Kembali
                                                    @include('addOn.sort-icon',['field'=>'sewa_tglkembali'])
                                                </th>
                                                <th wire:click="sortBy('status_sewa.status_detail')" style="cursor: pointer;">
                                                    Status
                                                    @include('addOn.sort-icon',['field'=>'status_sewa.status_detail'])
                                                </th>
                                                <th>Update Status</th>
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
                                                    <td class="btn waves-effect waves-light" title="Detail" wire:click="showDetailPage('{{$row->sewa_no}}')">{{$row->sewa_no}}</td>
                                                    <td>{{$row->user->user_nama}}</td>
                                                    <td>{{  \Carbon\Carbon::parse($row->sewa_tglsewa)->format('d, M Y') }}</td>
                                                    <td>{{  \Carbon\Carbon::parse($row->sewa_tglkembali)->format('d, M Y') }}</td>
                                                    <td>
                                                        @if ($row->sewa_status == 0)
                                                            <b style="color: red"> {{$row->status_sewa->status_detail}} </b>
                                                        @elseif($row->sewa_status == 1)
                                                            <b style="color: #9db325 "> {{$row->status_sewa->status_detail}} </b>
                                                        @elseif($row->sewa_status == 3 or $row->sewa_status == 4 or $row->sewa_status == 5)
                                                            <b style="color: #0AC8C8"> {{$row->status_sewa->status_detail}} </b>
                                                        @elseif($row->sewa_status == 2)
                                                            <b style="color: orange"> {{$row->status_sewa->status_detail}} </b>
                                                        @elseif($row->sewa_status == 6)
                                                            <b style="color: #62ed05"> {{$row->status_sewa->status_detail}} </b>
                                                        @else
                                                            <b style="color: red"> {{$row->status_sewa->status_detail}} </b>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        @if($row->sewa_status == 3 or $row->sewa_status == 4)
                                                        <a wire:click="updateStatus('{{ $row->sewa_no }}')" class="btn btn-info btn-rounded waves-effect waves-light" title="Update Status"><i class="fas fa-sync-alt" style="color: white"></i></a>
                                                        @else
                                                            -
                                                        @endif
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

</div>
