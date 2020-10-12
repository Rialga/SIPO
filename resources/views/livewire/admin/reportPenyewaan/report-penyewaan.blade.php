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
                            <h4 class="mb-0 font-size-18">Report</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="row mb-2">
                            <div class="col-sm-8 mb-2">

                                <div class="form-horizontal">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="date" name="denda" class="form-control mr-2" />
                                            <label class="pt-2 mr-2"> - </label>
                                            <input type="date" name="denda" class="form-control mr-2" />
                                            <a class="btn btn-info" style="color: white">cari</a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-4" style="display: flex; justify-content: flex-end">
                                <div class="form-horizontal">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="text" name="denda" class="form-control" placeholder="Cari (nama/tujuan/invc)" />
                                            <a class="btn btn-info" style="color: white"><i class="bx bx-search-alt search-icon"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="table-responsive">

                            <table>

                                <tr>
                                    <div class="card">
                                        <div class="card-body">
                                            <p> <b>12 Desember 2020</b> </p>
                                            <hr width="100%">

                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <a class="mb-4" data-toggle="collapse" href="#sewa" aria-expanded="false" aria-controls="collapseExample">
                                                        <b style="color: green"> INVC/II/20201011/000020 </b>
                                                    </a>
                                                </div>

                                                <div class="col-lg-2" style="text-align: center">
                                                        Nama Penyewa : <b>Burhano aniki</b> <br><br>
                                                        Tujuan : <b>Padang</b>
                                                </div>

                                                 <div class="col-lg-4" style="text-align: center">
                                                    Tanggal Sewa : <b>12 Desember 2020</b> <br>
                                                    Tanggal Kembali : <b>12 Desember 2020</b> <br>
                                                    Estimasi : <b>2 Hari</b> <br>

                                                </div>
                                                <div class="col-lg-3" style="text-align: right">
                                                     Total Pembayaran : <br>
                                                     <h4 style="color: orange"> Rp 12.000.00 </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>



                            </table>
                        </div>

                    </div> <!-- end col -->
                </div> <!-- end row -->
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

<script type="text/javascript">



</script>
