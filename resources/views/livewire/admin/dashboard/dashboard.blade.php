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
                            <h4 class="mb-0 font-size-18">Dashboard</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4 text-muted">Sewa Hari Ini</h4>
                                <h1 style="color: #46A07E"> {{ $sewa_hariini->count() }}  </h1>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-9">

                        <div class="card">

                            <div class="card-body row">

                                <div class="col-lg-4">
                                    <h4 class="card-title mb-4 text-muted">Jumlah Sewa ({{ $filter }})</h4>
                                    <h1 style="color: #17B5DB">  {{ count($totalBiaya) }} </h1>
                                </div>

                                <div class="col-lg-4">
                                    <h4 class="card-title mb-4 text-muted">Total Pendapatan ({{ $filter }})</h4>
                                    <h1 style="color: #17B5DB">  Rp. {{ number_format(array_sum($totalBiaya)) }}  </h1>
                                </div>

                                <div class="col-lg-4" style="text-align: right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Pendapatan Berdasarkan  <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" wire:click="filter('Semua')" style="cursor: pointer;">Semua</a>
                                            <a class="dropdown-item" wire:click="filter('Bulan Ini')" style="cursor: pointer;">Bulan Ini</a>
                                            <a class="dropdown-item" wire:click="filter('Tahun Ini')" style="cursor: pointer;">Tahun Ini</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <h4 class="card-title mb-4">Grafik Penyewaan </h4>
                                    </div>
                                    <div class="col-lg-9">
                                        <ul class="nav nav-pills nav-justified" role="tablist">
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link active" data-toggle="tab" href="#minggu" role="tab">
                                                    <span class="d-block d-sm-none">Mgg</i></span>
                                                    <span class="d-none d-sm-block">Mgg</span>
                                                </a>
                                            </li>
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link " data-toggle="tab" href="#bulan" role="tab">
                                                    <span class="d-block d-sm-none">Bln</i></span>
                                                    <span class="d-none d-sm-block">Bln</span>
                                                </a>
                                            </li>
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link " data-toggle="tab" href="#tahun" role="tab">
                                                    <span class="d-block d-sm-none">Thn</span>
                                                    <span class="d-none d-sm-block">Thn</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-12 tab-content">
                                        <div class="tab-pane active" id="minggu" role="tabpanel">
                                            <canvas class="chart" id="line-minggu" width="400" height="150"></canvas>
                                        </div>
                                        <div class="tab-pane " id="bulan" role="tabpanel">
                                            <canvas class="chart" id="line-bulan" width="400" height="150"></canvas>
                                        </div>
                                        <div class="tab-pane " id="tahun" role="tabpanel">
                                            <canvas class="chart" id="line-tahun" width="400" height="150"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>




                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Perbandingan Jenis Alat berdasarkan Jumlah Penyewaan</h4>
                                <canvas class="chart" id="bar-chart" width="400" height="150"></canvas>
                            </div>
                        </div>
                    </div>

                </div>

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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="{{ asset('assets/libs/chart/Chart.min.js') }}"></script>


<script type="text/javascript">

window.addEventListener('chart', event => {
    fullChart()
})


$(document).ready( function () {
    fullChart()
})


function fullChart(){

    var lineMinggu = document.getElementById('line-minggu').getContext('2d');
    var lineBulan = document.getElementById('line-bulan').getContext('2d');
    var lineTahun = document.getElementById('line-tahun').getContext('2d');

    var bar = document.getElementById('bar-chart').getContext('2d');


    var dataLabel = {!! json_encode($data_label) !!};
    var dataChart = {!! json_encode($data_chart) !!};

    // Line Chart
    var myLineChart = new Chart(lineMinggu, {
        type: 'line',
        data: {
            labels: dataLabel['minggu'],
            datasets: [{
                label: 'jumlah penyewaan',
                data: dataChart['minggu'],
                fill:false,
                borderColor: 'rgb(75, 192, 192)',

            }],
        },
        options: {
            legend: {
                display: false,

            },
            scales:{
                xAxes: [{
                    display: false,
                }]
            }
        },


    });

    var myLineChart2 = new Chart(lineBulan, {
        type: 'line',
        data: {
            labels: dataLabel['bulan'],
            datasets: [{
                label: 'jumlah penyewaan',
                data: dataChart['bulan'],
                fill:false,
                borderColor: 'rgb(75, 192, 192)',

            }],
        },
        options: {
            legend: {
                display: false,
            },
            scales:{
                xAxes: [{
                    display: false,
                }]
            }
        }

    });

    var myLineChart3 = new Chart(lineTahun, {
        type: 'line',
        data: {
            labels: dataLabel['tahun'],
            datasets: [{
                label: 'jumlah penyewaan',
                data: dataChart['tahun'],
                fill:false,
                borderColor: 'rgb(75, 192, 192)',

            }],
        },
        options: {
            legend: {
                display: false,
            },

        }

    });



    // Bar Chart
    function dynamicColors() {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        return "rgba(" + r + "," + g + "," + b + ", 0.8)";
    }

    function poolColors(a) {
        var pool = [];
        for(i = 0; i < a; i++) {
            pool.push(dynamicColors());
        }
        return pool;
    }

    var myBarChart = new Chart(bar, {
        type: 'horizontalBar',
        data: {
            labels: dataLabel['alat'],
            datasets: [{
                data: dataChart['alat'],
                backgroundColor: poolColors(dataChart['alat'].length),
                borderColor: poolColors(dataChart['alat'].length),
                borderWidth: 0.5
            }],
        },
        options:{
            legend: {
                display: false,
            },
            scales: {
                xAxes: [{
                    ticks: {
                    beginAtZero: true,
                    }
                }]
            }
        }

});

}

</script>
