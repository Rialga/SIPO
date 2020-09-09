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
                                <h4 class="mb-0 font-size-18">Konfirmasi Pengembalian</h4>

                                <h4 wire:loading> Loading . . . </h4>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                @if($detailPage)


                    @include('livewire.admin.konfirmasiPengembalian.pengembalianDetail')


                @else


                <div class="row">

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
                                            <th> Nama Penyewa </th>
                                            <th wire:click="sortBy('sewa_tglsewa')" style="cursor: pointer;">
                                                Tanggal Pinjam
                                                @include('addOn.sort-icon',['field'=>'sewa_tglsewa'])
                                            </th>
                                            <th wire:click="sortBy('sewa_tglkembali')" style="cursor: pointer;">
                                                Tanggal Kembali
                                                @include('addOn.sort-icon',['field'=>'sewa_tglkembali'])
                                            </th>
                                            <th wire:click="sortBy('sewa_status')" style="cursor: pointer;">
                                                Status
                                                @include('addOn.sort-icon',['field'=>'sewa_status'])
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
                                                <td class="btn waves-effect waves-light" title="Detail" wire:click="showDetailPage('{{$row->sewa_no}}')">{{$row->sewa_no}}</td>
                                                @if($row->sewa_status == 1)
                                                <td>{{$row->user->user_nama}}</td>
                                                @else
                                                <td>{{$row->sewa_offnama}}</td>
                                                @endif
                                                <td>{{ \Carbon\Carbon::parse($row->sewa_tglsewa)->format('d/m/Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($row->sewa_tglkembali)->format('d/m/Y') }}</td>
                                                <td>{{$row->status_sewa->status_detail}}</td>
                                                <td>
                                                    <a wire:click="showDetailPage('{{$row->sewa_no}}'" class="btn btn-success btn-default waves-effect waves-light" title="Accept"><i class="fas fa-eye" style="color: white"></i></a>
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
