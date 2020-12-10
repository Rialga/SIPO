<div>

    <livewire:layouts.header />

    <div class="main-content" style="margin: auto;">
        <div class="page-content">
            <div class="container-fluid">

                <div class="row">

                    <livewire:layouts.sidebar />

                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">


                                <div class="col-lg-12">
                                    <h2 class="mb-5">Notifikasi</h2>
                                    @if($dataRefuse->count() + $dataKembali->count()== 0)
                                    <br><br>
                                    <h3 class="mb-5" style="text-align: center">
                                        <i style="color: red" class="mdi mdi-bell-off"></i>

                                        <i style="color: gray">Tidak Ada Notifikasi</i> <br><br>

                                    </h3>
                                    <br><br>
                                    @else

                                    <br>

                                    @foreach ($dataRefuse as $item)
                                    <div class="tab-content crypto-buy-sell-nav-content p-4">

                                        <h5 style="color: red"><i style="color: red" class="fas fa-bahai"></i> <b>Bukti Pembayaran Ditolak</b> </h5>
                                        <a wire:click = "page('{{ $item->sewa_no }}' , 7)" style="cursor: pointer;">
                                            <p>
                                                No Invoice  <b>{{ $item->sewa_no }}</b>.
                                                Untuk penyewan <b>{{ Carbon\Carbon::parse($item->sewa_tglsewa)->format('d, M Y') }}</b> -
                                                <b>{{ Carbon\Carbon::parse($item->sewa_tglkembali)->format('d, M Y') }}</b>.
                                                Tujuan <b>{{ $item->sewa_tujuan }}</b>
                                            </p>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{ Carbon\Carbon::parse($item->updated_at)->format('d, M Y - H:i A ') }} </p>
                                            </div>
                                        </a>

                                    </div>
                                    @endforeach

                                    @foreach ($dataKembali as $item)
                                    <div class="tab-content crypto-buy-sell-nav-content p-4">

                                        <h5 style="color: orange"><i style="color: orange" class="fas fa-bahai"></i> <b>Reminder Pengembalian Barang !!!</b> </h5>
                                        <a wire:click = "page('{{ $item->sewa_no }}' , 7)" style="cursor: pointer;">
                                            <p>
                                                No Invoice  <b>{{ $item->sewa_no }}</b>.
                                                Untuk penyewan <b>{{ Carbon\Carbon::parse($item->sewa_tglsewa)->format('d, M Y') }}</b> -
                                                <b>{{ Carbon\Carbon::parse($item->sewa_tglkembali)->format('d, M Y') }}</b>.
                                                Tujuan <b>{{ $item->sewa_tujuan }}</b>
                                            </p>
                                        </a>

                                    </div>
                                    @endforeach

                                    <br><br>

                                    @endif



                                </div>



                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <livewire:layouts.footer />
    </div>


    </div>
