<div>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box" style="position:relative;  left:40px;">
                <a href="{{ url('/') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src={{ asset("assets/images/logo.svg")}} alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src={{ asset("assets/images/logo-dark.png")}} alt="" height="17">
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src={{ asset("assets/images/logo-light.svg")}} alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src={{ asset("assets/images/logo-light.png")}} alt="" height="19">
                    </span>
                </a>
            </div>
        </div>

        <div class="d-flex" style="position:relative;  right:100px;">

            @auth

            {{-- Notif --}}
            <div class="d-flex" wire:poll.5000ms="updateNotif">
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-bell bx-tada"></i>
                        @if($dataRefuse->count() > 0)
                        <span class="badge badge-danger badge-pill">{{ $dataRefuse->count() }}</span>
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                        aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> Notifikasi </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="#!" class="small"> View All</a>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 230px;">
                        @forelse($dataRefuse as $item)
                        <a wire:poll.5000ms wire:click="page('{{ $item->sewa_no }}')" class="text-reset notification-item" style="cursor: pointer;">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title bg-danger rounded-circle font-size-16">
                                        <i class="mdi mdi-cancel"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">{{ $item->sewa_no }}</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1" style="color: red">Pembayaran Ditolak</p>
                                        <p class="mb-0"><i class="far fa-calendar-alt"></i> {{  \Carbon\Carbon::parse($item->sewa_tglbayar)->format('d, M Y') }} | <i class="mdi mdi-clock-outline"></i> {{  \Carbon\Carbon::parse($item->sewa_tglbayar)->format('h:i') }} WIB</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @empty
                            <a class="text-reset notification-item">
                                <div class="media">
                                    <p>Tidak Ada Notifikasi</p>
                                </div>
                            </a>
                        @endforelse
                        </div>
                        <div class="p-2 border-top">
                            <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                                <i class="mdi mdi-arrow-right-circle mr-1"></i> View More..
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Cart --}}
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-cart"></i>
                    @if($cartTotal == 0)
                    <span class="badge badge-danger badge-pill"></span>
                    @else
                    <span class="badge badge-danger badge-pill">{{ $cartTotal }}</span>
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Cart </h6>
                            </div>
                            <div class="col-auto">
                                <a href="{{ url('/cart') }}"class="small"> View All</a>
                            </div>
                        </div>
                    </div>


                    <div data-simplebar style="max-height: 230px;">
                        @forelse(\Cart::session( auth()->id())->getContent() as $item)
                            <a href="#" class="text-reset notification-item">
                                <div class="media">
                                    <div class="avatar-xs mr-3">
                                        <img class="rounded-circle header-profile-user" src={{ asset("storage/gambarAlat/".$item->attributes->pic) }} alt="Header Avatar">
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1">{{ $item->name }} ({{ $item->attributes->merk }})</h6>
                                        <div class="font-size-6 text-muted">
                                            <p class="mb-1">{{ $item->attributes->type }}</p>
                                        </div>
                                        <div  style="display: flex; justify-content: flex-end">
                                            <p class="mb-1" style="color: orangered">Rp. {{ $item->price }}</p> &nbsp;
                                            <p class="mb-1"> x {{ $item->quantity }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <a class="text-reset notification-item">
                                <div class="media">
                                    <p>Cart Kosong</p>
                                </div>
                            </a>
                        @endforelse
                    </div>


                    <div class="p-2 border-top">
                        <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="{{ url('/cart') }}">
                            <i class="mdi mdi-arrow-right-circle mr-1"></i> View More..
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown">
                    <img class="rounded-circle header-profile-user" src={{ asset("assets/images/users/avatar-1.jpg")}} alt="Header Avatar" style="position:relative;  top:-6px;">
                    <span class="d-none d-xl-inline-block ml-1" style="position:relative;  bottom:5px;"> {{ Auth::user()->user_nama }}</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right" id="page-header-user-dropdown">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ url('/profile') }}"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a wire:click="logout" class="dropdown-item text-danger" style="cursor: pointer;"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
                </div>
            </div>
            @endauth

            @guest
            <div class="d-inline-block">
                <a  href="{{ url('/login') }}" type="button" class="btn header-item waves-effect">
                    <br>
                    <i class="bx bx-log-in"></i>
                    <span class="d-none d-xl-inline-block ml-1">Login</span>
                </a>
            </div>
            <div type="button" class="d-inline-block">
                <a href="{{ url('/register') }}" class="btn header-item waves-effect">
                    <br>
                    <i class="fas fa-user-plus"></i>
                    <span class="d-none d-xl-inline-block ml-1">Register</span>
                </a>
            </div>
            @endguest

        </div>
    </div>
</header>
</div>


