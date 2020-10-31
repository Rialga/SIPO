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
                            <div class="card-body" style="text-align: center">
                                <h4 class="card-title mb-4">Jumlah Sewa Hari Ini</h4>
                                <h1 style="color: #46A07E"> 1  </h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body" style="text-align: center">
                                <h4 class="card-title mb-4">Total Sewa Bulan ini</h4>
                                <h1 style="color: #17B5DB"> 27  </h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <h1 style="text-align: right; color: #386957" class="mt-4"><b> Dashboard Penyewaan Sumbar Mountain Adventure </b></h1>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Jumlah penyewaan </h4>
                                <canvas class="chart" id="line-chart" width="400" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Perbandingan Jenis Alat berdasarkan Jumlah pemakaian</h4>
                                <canvas class="chart" id="bar-chart" width="400" height="300"></canvas>
                            </div>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Perbandingan Jumlah Merk</h4>
                                <canvas class="chart" id="doughnut-chart" width="400" height="300"></canvas>
                            </div>
                        </div>
                    </div> <!-- end col -->
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


<script src="{{ asset('assets/libs/chart/Chart.min.js') }}"></script>
<script type="text/javascript">

var line = document.getElementById('line-chart').getContext('2d');
var bar = document.getElementById('bar-chart').getContext('2d');
var doughnut = document.getElementById('doughnut-chart').getContext('2d');




var myLineChart = new Chart(line, {
    type: 'line',
    data: {
        datasets: [{
            data: [1,2,3],
        }],
    },
    options: {}

});

var myBarChart = new Chart(bar, {
    type: 'horizontalBar',
    data: {
        labels:['satu' , 'dua' , 'tiga'],
        datasets: [{
            data: [ 1,2,3],
        }],
    },
    options:{
        scales: {
            xAxes: [{
                ticks: {
                beginAtZero: true,
                min : 0,
                }
            }]
        }
    }

});

var myDoughnutchart = new Chart(doughnut, {
    type: 'doughnut',
    data: {
        labels:['satu' , 'dua' , 'tiga'],
        datasets: [{
            data: [ 22,22,30],
        }],
    },
    options: {}


});

</script>
