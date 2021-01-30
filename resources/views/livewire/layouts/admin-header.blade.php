<div>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ url('dashboard/') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="20">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="40">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block">
                <button type="button"  wire:poll.5000ms="updateNotif" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-bell bx-tada"></i>
                    @if($dataNotif->count() + $dataReminder->count()  > 0)
                    <span class="badge badge-danger badge-pill">{{ $dataNotif->count() + $dataReminder->count() }} </span>&nbsp;
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifikasi </h6>
                            </div>
                            <div class="col-auto">
                                <a href="{{ url('/list-sewa') }}" class="small"> View All</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                    @if($dataNotif->count() + $dataReminder->count() == 0)
                        <a class="text-reset notification-item">
                            <div class="media">
                                <p>Tidak Ada Notifikasi</p>
                            </div>
                        </a>
                    @endif
                    @foreach($dataNotif as $item)
                    <a wire:click="page('{{ $item->sewa_no }}',1)" class="text-reset notification-item" style="cursor: pointer;">
                        <div class="media">
                            <div class="avatar-xs mr-3">
                                <span class="avatar-title bg-warning rounded-circle font-size-16">
                                    <i class="fas fa-money-bill-alt"></i>
                                </span>
                            </div>
                            <div class="media-body">
                                <h6 class="mt-0 mb-1">{{ $item->sewa_no }}</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1" style="color: orangered">Pembayaran</p>
                                    <p class="mb-0"><i class="far fa-calendar-alt"></i> {{  \Carbon\Carbon::parse($item->sewa_tglbayar)->format('d, M Y') }} | <i class="mdi mdi-clock-outline"></i> {{  \Carbon\Carbon::parse($item->sewa_tglbayar)->format('h:i') }} WIB</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    @foreach($dataReminder as $item)
                    <a wire:click="page('{{ $item->sewa_no }}',2)" class="text-reset notification-item" style="cursor: pointer;">
                        <div class="media">
                            <div class="avatar-xs mr-3">
                                <span class="avatar-title bg-info rounded-circle font-size-16">
                                    <i class="fa fa-exclamation"></i>
                                </span>
                            </div>
                            <div class="media-body">
                                <h6 class="mt-0 mb-1">{{ $item->sewa_no }}</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1" style="color: orangered">Pengembalian</p>
                                    <p class="mb-0"><i class="far fa-calendar-alt"></i> {{  \Carbon\Carbon::parse($item->sewa_tglKembali)->format('d, M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    </div>
                    <div class="p-2 border-top">
                        <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="{{ url('/list-sewa') }}">
                            <i class="mdi mdi-arrow-right-circle mr-1"></i> View More..
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown">
                    <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="Header Avatar" style="position:relative;  top:-6px;">
                    @auth
                    <span class="d-none d-xl-inline-block ml-1" style="position:relative;  top:10px;"> {{ Auth::user()->user_nama }} <br>( {{ Auth::user()->role->role_nama }} )</span>
                    @endauth
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" id="page-header-user-dropdown">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ url('/profile-data') }}"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a wire:click="logout" class="dropdown-item text-danger" style="cursor: pointer;"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>
</div>
