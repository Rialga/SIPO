<div>
    <header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 30, 'stickyHeaderContainerHeight': 70}">
        <div class="header-body">
            <div class="header-container container">
                <div class="header-row">
                    <div class="header-column">
                        <div class="header-row">
                            <div class="header-logo">
                                <a href="{{ url('/') }}">
                                    <img alt="Porto" width="100" height="48" data-sticky-width="82" data-sticky-height="40" src="/assets/cust-assets/img/logo.png">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="header-column justify-content-center">
                        <div class="header-row col-12">
                            <div class="col-12">
                                <form action="">
                                    <div class="simple-search input-group w-auto">
                                        <input class="form-control text-1" id="headerSearch" name="q" type="search" value="" placeholder="Search...">
                                        <span class="input-group-append">
                                    <button class="btn" type="submit">
                                        <i class="fa fa-search header-nav-top-icon"></i>
                                    </button>
                                </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="header-column justify-content-end">
                        <div class="header-row">
                            <div class="header-nav header-nav-line header-nav-top-line header-nav-top-line-with-border order-2 order-lg-1">
                                <div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                    <nav class="collapse">
                                        <ul class="nav nav-pills" id="mainNav">

                                            @auth
                                            <li class="dropdown">
                                                <a class="dropdown-item" wire:click="logout">
                                                    Logout
                                                </a>
                                            </li>
                                            @endauth

                                            @guest
                                            <li class="dropdown">
                                                <a class="dropdown-item" href="{{ url('/login') }}">
                                                    Masuk
                                                </a>
                                            </li>
                                            <li class="dropdown dropdown-mega">
                                                <a class="dropdown-item" href="{{ url('/') }}">
                                                    Daftar
                                                </a>
                                            </li>
                                            @endguest
                                        </ul>
                                    </nav>
                                </div>
                                <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

</div>


