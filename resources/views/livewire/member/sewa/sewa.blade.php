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
                                                <a class="nav-link {{ $all }}" data-toggle="tab" href="#semua" role="tab" wire:click="changeStat('all')">
                                                    Semua
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ $checkout }}" data-toggle="tab" href="#belumBayar" role="tab" wire:click="changeStat('checkout')">
                                                    Belum Bayar
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ $done }}" data-toggle="tab" href="#selesai" role="tab" wire:click="changeStat('done')">
                                                    Selesai
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ $refuse }}" data-toggle="tab" href="#tolak" role="tab" wire:click="changeStat('refuse')">
                                                    Ditolak
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ $canceled }}" data-toggle="tab" href="#batal" role="tab" wire:click="changeStat('canceled')">
                                                    Dibatalkan
                                                </a>
                                            </li>
                                        </ul>

                                        <div class="tab-content crypto-buy-sell-nav-content p-4">

                                            {{-- Semua Jenis Trransaksi --}}
                                            <div class="tab-pane active" id="semua" role="tabpane">

                                                @include('livewire.member.sewa.sewaData')

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
    </div>
    <livewire:layouts.footer />

</div>
