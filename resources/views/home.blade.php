@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.css" integrity="sha512-72LrFm5Wau6YFp7GGd7+qQJYkzRKj5UMQZ4aFuEo3WcRzO0xyAkVjK3NEw8wXjEsEG/skqvXKR5+VgOuzuqPtA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <div class="card bg-default">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-light text-uppercase ls-1 mb-1">HARIAN</h6>
                            <h5 class="h3 text-white mb-0">GRAFIK JUMLAH SETORAN HARIAN</h5>
                        </div>
                        <div class="col">
                            <h5 class="h3 text-white mb-0">Bulan {{Date('F')}}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="chart-berkas-ruangan" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
            <div class="card bg-default">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-light text-uppercase ls-1 mb-1">PENGEMBALIAN</h6>
                            <h5 class="h3 text-white mb-0">GRAFIK PENGEMBALIAN < 24 JAM</h5>
                        </div>
                        <div class="col">
                            <h5 class="h3 text-white mb-0">Bulan {{Date('F')}}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="w-100 d-flex justify-content-center">
                                <div class="bg-danger mx-2" style="width: 30px; height:20px;border-radius:10px;background-color:#007500 !important;"></div><div>% TEPAT</div>
                                <div class="bg-success mx-2" style="width: 30px; height:20px;border-radius:10px;background-color:#FF0000 !important"></div><div>% TT</div>
                            </div>
                        </div>
                    </div>
                    <div class="chart">
                        <canvas id="chart-berkas-pengembalian" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center mb-2">Prosentase Tepat</div>
                            <div class="chart">
                                <div id="chart-diagram-ruangan" class="chart-canvas"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center mb-2">Prosentase Tidak Tepat</div>
                            <div class="chart">
                                <div id="chart-diagram-ruangan-tidak" class="chart-canvas"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js" integrity="sha512-yhdujT21BI/kqk9gcupTh4jMwqLhb+gc6Ytgs4cL0BJjXW+Jo9QyllqLbuluI0cBHqV4XsR7US3lemEGjogQ0w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('script-view')
<script>
var SalesChart = (function() {

// Variables

var $chart = $('#chart-berkas-ruangan');

let totalHari =  <?php echo $totalHari ?>;
let labelHari =  <?php echo $labelHari ?>;
// Methods

function init($this) {
    var salesChart = new Chart($this, {
        type: 'line',
        options: {
            scales: {
                yAxes: [{
                    gridLines: {
                        color: Charts.colors.gray[700],
                        zeroLineColor: Charts.colors.gray[700]
                    },
                    ticks: {

                    }
                }]
            }
        },
        data: {
            labels: labelHari,
            datasets: [{
                label: 'Jumlah',
                data: totalHari
            }]
        }
    });

    // Save to jQuery object

    $this.data('chart', salesChart);

};


// Events

if ($chart.length) {
    init($chart);
}

})();

var SalesChart1 = (function() {

// Variables

var $chart1 = $('#chart-berkas-pengembalian');

let ruangan =  <?php echo $ruangan ?>;
let total24 =  <?php echo $total24 ?>;
let totalNo24 =  <?php echo $totalNo24 ?>;
let percentTepat =  <?php echo $percentTepat ?>;
let percentTidakTepat =  <?php echo $percentTidakTepat ?>;
// Methods

function init($this) {
    var salesChart1 = new Chart($this, {
        type: 'bar',
        options: {
            scales: {
                yAxes: [{
                    gridLines: {
                        color: Charts.colors.gray[700],
                        zeroLineColor: Charts.colors.gray[700]
                    },
                    ticks: {

                    }
                }]
            },
            plugins: {
            legend: {
                display: true,
            }
        }
        },
        data: {
            labels: ruangan,
            datasets: [{
                label: 'Tepat',
                data: percentTepat,
                backgroundColor: 'green',
            },{
                label: 'Tidak Tepat',
                data: percentTidakTepat,
                backgroundColor: 'red',
            }]
        }
    });

    // Save to jQuery object

    $this.data('chart', SalesChart1);

};


// Events

if ($chart1.length) {
    init($chart1);
}

})();

let ruangan =  <?php echo $ruangan ?>;
let total24 =  <?php echo $total24 ?>;
let totalNo24 =  <?php echo $totalNo24 ?>;

var options = {
    series: total24,
    chart: {
    width: 400,
    type: 'pie',
},
labels: ruangan,
responsive: [{
    breakpoint: 480,
    options: {
    chart: {
        width: 200
    },
    legend: {
        position: 'bottom'
    }
    }
}]
};

var chart = new ApexCharts(document.querySelector("#chart-diagram-ruangan"), options);
chart.render();

var options1 = {
    series: totalNo24,
    chart: {
    width: 400,
    type: 'pie',
},
labels: ruangan,
responsive: [{
    breakpoint: 480,
    options: {
    chart: {
        width: 200
    },
    legend: {
        position: 'bottom'
    }
    }
}]
};

var chart1 = new ApexCharts(document.querySelector("#chart-diagram-ruangan-tidak"), options1);
chart1.render();
</script>
@endsection
