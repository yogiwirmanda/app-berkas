@extends('layouts.main')

@section('content')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <div class="card bg-default">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-light text-uppercase ls-1 mb-1">Total</h6>
                            <h5 class="h3 text-white mb-0">Berkas</h5>
                        </div>
                        <div class="col">
                            <h5 class="h3 text-white mb-0">Bulan Mei</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="chart-berkas-ruangan" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script-view')
<script>
var SalesChart = (function() {

// Variables

var $chart = $('#chart-berkas-ruangan');

let ruangan =  <?php echo $ruangan ?>;
let total =  <?php echo $ruanganTotal ?>;
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
            labels: ruangan,
            datasets: [{
                label: 'Total Berkas',
                data: total
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
</script>
@endsection
