<div>
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->

            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ url('/dashboard') }}" class=" waves-effect">
                        <i class="bx bxs-pie-chart-alt-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a class="has-arrow waves-effect">
                        <i class="fas fa-users"></i>
                        <span>Kelola Data User</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('/petugas') }}" class="waves-effect">
                              <i class="fas fa-id-card-alt"></i>
                                <span>Petugas</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/member') }}" class=" waves-effect">
                              <i class="fas fa-id-card"></i>
                                <span>Member</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a class="has-arrow waves-effect">
                        <i class="mdi mdi-campfire"></i>
                        <span>Kelola Alat</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('/alat') }}" class="waves-effect">
                              <i class="fas fa-binoculars"></i>
                                <span>Alat</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/jenis') }}" class=" waves-effect">
                              <i class="fas fa-cubes"></i>
                                <span>Jenis</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/merk') }}" class=" waves-effect">
                                <i class="fas fa-tags"></i>
                                <span>Merk</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="{{ url('/kelola-denda') }}" class=" waves-effect">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>Kelola Denda</span>
                    </a>
                </li>

                <li>
                    <a class="has-arrow waves-effect">
                        <i class="bx bx-transfer-alt"></i>
                        <span>Penyewaan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('/list-sewa') }}" class="waves-effect">
                                <i class="mdi mdi-clipboard-list"></i>
                                <span>List Transaksi Sewa</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/konfirmasi-pembayaran') }}" class="waves-effect">
                                <i class="mdi mdi-wallet"></i>
                                <span>Pembayaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/pengembalian') }}" class=" waves-effect">
                                <i class="fas fa-check-circle"></i>
                                <span>Pengembalian</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="{{ url('/report-penyewaan') }}" class=" waves-effect">
                        <i class="bx bx bxs-file"></i>
                        <span>Report Penyewaan</span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
</div>
