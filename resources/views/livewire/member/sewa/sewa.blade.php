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
                                    <h2 class="mb-4">Penyewaan</h2>
                                    <div class="crypto-buy-sell-nav">
                                        <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#semua" role="tab">
                                                    Semua
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#belumBayar" role="tab">
                                                    Belum Bayar
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#selesai" role="tab">
                                                    Selsai
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#batal" role="tab">
                                                    Dibatalkan
                                                </a>
                                            </li>
                                        </ul>

                                        <div class="tab-content crypto-buy-sell-nav-content p-4">

                                            {{-- Semua Jenis Trransaksi --}}
                                            <div class="tab-pane active" id="semua" role="tabpanel">
                                                <form>
                                                    Ini Semua
                                                </form>
                                            </div>

                                            {{-- transaksi status belum bayar --}}
                                            <div class="tab-pane" id="belumBayar" role="tabpanel">
                                                <form>
                                                    Ini Belum Bayar
                                                </form>
                                            </div>

                                            {{-- transaksi status selesai --}}
                                            <div class="tab-pane" id="selesai" role="tabpanel">
                                                <form>
                                                    Ini Selesai
                                                </form>
                                            </div>

                                            {{-- transaksi status dibatalkan --}}
                                            <div class="tab-pane" id="batal" role="tabpanel">
                                                <form>
                                                    Ini Dibatalkan
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
