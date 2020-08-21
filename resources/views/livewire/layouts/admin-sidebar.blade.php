
    <aside id="sidebar-left" class="sidebar-left">
        <div class="sidebar-header">
            <div class="sidebar-title">
                Navigation
            </div>
            <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>

        <div class="nano">
            <div class="nano-content">
                <nav id="menu" class="nav-main" role="navigation">

                    <ul class="nav nav-main">
                        <li class="nav-">
                           <a class="nav-link" href="{{ url('/dashboard') }}">
                                <i class="fas fa-chart-pie" aria-hidden="true"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-parent">
                            <a class="nav-link" href="#">
                                <i class="fas fa-users" aria-hidden="true"></i>
                                <span>Kelola Data User</span>
                            </a>
                            <ul class="nav nav-children">
                                <li>
                                    <a><i class="fas fa-id-badge" aria-hidden="true"></i>Petugas</a>
                                </li>
                                <li>
                                    <a><i class="fas fa-id-card" aria-hidden="true"></i>Member</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-parent">
                            <a class="nav-link" href="#">
                                <i class="fas fa-campground" aria-hidden="true"></i>
                                <span>Kelola Alat</span>
                            </a>
                            <ul class="nav nav-children">
                                <li>
                                    <a href="{{ url('/alat') }}"><i class="fas fa-binoculars" aria-hidden="true"></i>Alat</a>
                                </li>
                                <li>
                                    <a><i class="fas fa-cubes" aria-hidden="true"></i>Jenis</a>
                                </li>
                                <li>
                                    <a><i class="fas fa-tags" aria-hidden="true"></i>Merk</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-">
                            <a class="nav-link" href="{{ url('/') }}">
                                 <i class="fas fa-money-bill-wave" aria-hidden="true"></i>
                                 <span>Kelola Denda</span>
                             </a>
                         </li>


                         <li class="nav-parent">
                            <a class="nav-link" href="#">
                                <i class="fas fa-exchange-alt" aria-hidden="true"></i>
                                <span>Penyewaan</span>
                            </a>
                            <ul class="nav nav-children">
                                <li>
                                    <a><i class="fas fa-clipboard-list" aria-hidden="true"></i>List Transaksi Sewa</a>
                                </li>
                                <li>
                                    <a><i class="fas fa-check-circle" aria-hidden="true"></i>Konfirmasi Pengembalian</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-">
                            <a class="nav-link" href="{{ url('/login') }}">
                                 <i class="fas fa-file-alt" aria-hidden="true"></i>
                                 <span>Report Transaksi Peenyewaan</span>
                             </a>
                         </li>

                    </ul>
                </nav>

            </div>

            <script>
                // Maintain Scroll Position
                if (typeof localStorage !== 'undefined') {
                    if (localStorage.getItem('sidebar-left-position') !== null) {
                        var initialPosition = localStorage.getItem('sidebar-left-position'),
                            sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                        sidebarLeft.scrollTop = initialPosition;
                    }
                }
            </script>


        </div>

    </aside>


