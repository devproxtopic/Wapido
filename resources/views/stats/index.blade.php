@extends('layouts.admin')

@section('title', 'Estadísticas')
@section('display_create', 'display:none;')

@section('content')
<div class="row">
    <div class="col-lg col-md-6 col-sm-6 mb-4">
        <div class="stats-small stats-small--1 card card-small">
        <div class="card-body p-0 d-flex">
            <div class="d-flex flex-column m-auto">
            <div class="stats-small__data text-center">
                <span class="stats-small__label text-uppercase">Pedidos al año</span>
                <h6 class="stats-small__value count my-3">{{ $orders_year->count() }}</h6>
            </div>
            {{-- <div class="stats-small__data">
                <span class="stats-small__percentage stats-small__percentage--increase">4.7%</span>
            </div> --}}
            </div>
            <canvas height="120" class="blog-overview-stats-small-1"></canvas>
        </div>
        </div>
    </div>
    <div class="col-lg col-md-6 col-sm-6 mb-4">
        <div class="stats-small stats-small--1 card card-small">
        <div class="card-body p-0 d-flex">
            <div class="d-flex flex-column m-auto">
            <div class="stats-small__data text-center">
                <span class="stats-small__label text-uppercase">Pedidos al mes</span>
                <h6 class="stats-small__value count my-3">{{ $orders_month->count() }}</h6>
            </div>
            {{-- <div class="stats-small__data">
                <span class="stats-small__percentage stats-small__percentage--increase">12.4%</span>
            </div> --}}
            </div>
            <canvas height="120" class="blog-overview-stats-small-2"></canvas>
        </div>
        </div>
    </div>
    <div class="col-lg col-md-4 col-sm-6 mb-4">
        <div class="stats-small stats-small--1 card card-small">
        <div class="card-body p-0 d-flex">
            <div class="d-flex flex-column m-auto">
            <div class="stats-small__data text-center">
                <span class="stats-small__label text-uppercase">Pedidos 15 últimos días</span>
                <h6 class="stats-small__value count my-3">{{ $orders_fifteen->count() }}</h6>
            </div>
            {{-- <div class="stats-small__data">
                <span class="stats-small__percentage stats-small__percentage--decrease">3.8%</span>
            </div> --}}
            </div>
            <canvas height="120" class="blog-overview-stats-small-3"></canvas>
        </div>
        </div>
    </div>
    <div class="col-lg col-md-4 col-sm-6 mb-4">
        <div class="stats-small stats-small--1 card card-small">
        <div class="card-body p-0 d-flex">
            <div class="d-flex flex-column m-auto">
            <div class="stats-small__data text-center">
                <span class="stats-small__label text-uppercase">Pedidos del día</span>
                <h6 class="stats-small__value count my-3">{{ $orders_day->count() }}</h6>
            </div>
            {{-- <div class="stats-small__data">
                <span class="stats-small__percentage stats-small__percentage--increase">12.4%</span>
            </div> --}}
            </div>
            <canvas height="120" class="blog-overview-stats-small-4"></canvas>
        </div>
        </div>
    </div>
    <div class="col-lg col-md-4 col-sm-12 mb-4">
        <div class="stats-small stats-small--1 card card-small">
        <div class="card-body p-0 d-flex">
            <div class="d-flex flex-column m-auto">
            <div class="stats-small__data text-center">
                <span class="stats-small__label text-uppercase">Pedidos Cancelados del día</span>
                <h6 class="stats-small__value count my-3">{{ $orders_day->where('status_id', 7)->count() }}</h6>
            </div>
            {{-- <div class="stats-small__data">
                <span class="stats-small__percentage stats-small__percentage--decrease">2.4%</span>
            </div> --}}
            </div>
            <canvas height="120" class="blog-overview-stats-small-5"></canvas>
        </div>
        </div>
    </div>
</div>
<!-- End Small Stats Blocks -->
<div class="row">
    <!-- Items Stats -->
    <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
        <div class="card card-small">
        <div class="card-header border-bottom">
            <h6 class="m-0">Productos en el mes</h6>
        </div>
        <div class="card-body pt-0">
            {{-- <div class="row border-bottom py-2 bg-light">
            <div class="col-12 col-sm-6">
                <div id="items-range" class="input-daterange input-group input-group-sm my-auto ml-auto mr-auto ml-sm-auto mr-sm-0" style="max-width: 350px;">
                <input type="text" class="input-sm form-control" name="start" placeholder="Fecha Inicio" id="items-range-1">
                <input type="text" class="input-sm form-control" name="end" placeholder="Fecha Fin" id="items-range-2">
                <span class="input-group-append">
                    <span class="input-group-text">
                    <i class="material-icons"></i>
                    </span>
                </span>
                </div>
            </div>
            <div class="col-12 col-sm-6 d-flex mb-2 mb-sm-0">
                <button type="button" class="btn btn-sm btn-white ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0">View Full Report &rarr;</button>
            </div>
            </div>--}}
            <canvas height="130" style="max-width: 100% !important;" class="items-range-month"></canvas>
        </div>
        </div>
    </div>
    <!-- End Items Stats -->
    <!-- Items By Device Stats -->
    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        <div class="card card-small h-100">
        <div class="card-header border-bottom">
            <h6 class="m-0">Productos en el día</h6>
        </div>
        <div class="card-body d-flex py-0">
            <canvas height="220" class="items-day m-auto"></canvas>
        </div>
        {{-- <div class="card-footer border-top">
            <div class="row">
            <div class="col">
                <select class="custom-select custom-select-sm" style="max-width: 130px;">
                <option selected>Last Week</option>
                <option value="1">Today</option>
                <option value="2">Last Month</option>
                <option value="3">Last Year</option>
                </select>
            </div>
            <div class="col text-right view-report">
                <a href="#">Full report &rarr;</a>
            </div>
            </div>
        </div> --}}
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
(function ($) {
    $(document).ready(function () {

        // Blog overview date range init.
        $('#items-range').datepicker({});

        //
        // Small Stats
        //

        // Datasets
        var boSmallStatsDatasets = [
        {
            backgroundColor: 'rgba(0, 184, 216, 0.1)',
            borderColor: 'rgb(0, 184, 216)',
            data: [1, 2, 1, 3, 5, 4, 7],
        },
        {
            backgroundColor: 'rgba(23,198,113,0.1)',
            borderColor: 'rgb(23,198,113)',
            data: [1, 2, 3, 3, 3, 4, 4]
        },
        {
            backgroundColor: 'rgba(255,180,0,0.1)',
            borderColor: 'rgb(255,180,0)',
            data: [2, 3, 3, 3, 4, 3, 3]
        },
        {
            backgroundColor: 'rgba(255,65,105,0.1)',
            borderColor: 'rgb(255,65,105)',
            data: [1, 7, 1, 3, 1, 4, 8]
        },
        {
            backgroundColor: 'rgb(0,123,255,0.1)',
            borderColor: 'rgb(0,123,255)',
            data: [3, 2, 3, 2, 4, 5, 4]
        }
        ];

        // Options
        function boSmallStatsOptions(max) {
        return {
            maintainAspectRatio: true,
            responsive: true,
            // Uncomment the following line in order to disable the animations.
            // animation: false,
            legend: {
            display: false
            },
            tooltips: {
            enabled: false,
            custom: false
            },
            elements: {
            point: {
                radius: 0
            },
            line: {
                tension: 0.3
            }
            },
            scales: {
            xAxes: [{
                gridLines: false,
                scaleLabel: false,
                ticks: {
                display: false
                }
            }],
            yAxes: [{
                gridLines: false,
                scaleLabel: false,
                ticks: {
                display: false,
                // Avoid getting the graph line cut of at the top of the canvas.
                // Chart.js bug link: https://github.com/chartjs/Chart.js/issues/4790
                suggestedMax: max
                }
            }],
            },
        };
        }

        // Generate the small charts
        boSmallStatsDatasets.map(function (el, index) {
        var chartOptions = boSmallStatsOptions(Math.max.apply(Math, el.data) + 1);
        var ctx = document.getElementsByClassName('blog-overview-stats-small-' + (index + 1));
        new Chart(ctx, {
            type: 'line',
            data: {
            labels: ["Label 1", "Label 2", "Label 3", "Label 4", "Label 5", "Label 6", "Label 7"],
            datasets: [{
                label: 'Today',
                fill: 'start',
                data: el.data,
                backgroundColor: el.backgroundColor,
                borderColor: el.borderColor,
                borderWidth: 1.5,
            }]
            },
            options: chartOptions
        });
        });


        //
        // Blog Overview Users
        //

        var bouCtx = document.getElementsByClassName('items-range-month')[0];

        // Data
        var bouData = {
        // Generate the days labels on the X axis.
        labels: Array.from(new Array(30), function (_, i) {
            return i === 0 ? 1 : i;
        }),
        datasets: [
            @for($i=0;$i<count($orders_items_month);$i++)
                @isset($orders_items_month_label[$i])
                {
                    label: "{{ $orders_items_month_label[$i] }}",
                    fill: 'start',
                    data: "{{ $orders_items_month[$i] }}",
                    backgroundColor: 'rgba(0,123,255,0.1)',
                    borderColor: 'rgba(0,123,255,1)',
                    pointBackgroundColor: '#ffffff',
                    pointHoverBackgroundColor: 'rgb(0,123,255)',
                    borderWidth: 1.5,
                    pointRadius: 0,
                    pointHoverRadius: 3
                },
                @endisset
            @endfor
            ]
        };

        // Options
        var bouOptions = {
        responsive: true,
        legend: {
            position: 'top'
        },
        elements: {
            line: {
            // A higher value makes the line look skewed at this ratio.
            tension: 0.3
            },
            point: {
            radius: 0
            }
        },
        scales: {
            xAxes: [{
            gridLines: false,
            ticks: {
                callback: function (tick, index) {
                // Jump every 7 values on the X axis labels to avoid clutter.
                return index % 7 !== 0 ? '' : tick;
                }
            }
            }],
            yAxes: [{
            ticks: {
                suggestedMax: 45,
                callback: function (tick, index, ticks) {
                if (tick === 0) {
                    return tick;
                }
                // Format the amounts using Ks for thousands.
                return tick > 999 ? (tick/ 1000).toFixed(1) + 'K' : tick;
                }
            }
            }]
        },
        // Uncomment the next lines in order to disable the animations.
        // animation: {
        //   duration: 0
        // },
        hover: {
            mode: 'nearest',
            intersect: false
        },
        tooltips: {
            custom: false,
            mode: 'nearest',
            intersect: false
        }
        };

        // Generate the Analytics Overview chart.
        window.BlogOverviewUsers = new Chart(bouCtx, {
        type: 'bar',
        data: bouData,
        options: bouOptions
        });

        // Hide initially the first and last analytics overview chart points.
        // They can still be triggered on hover.
        var aocMeta = BlogOverviewUsers.getDatasetMeta(0);
        aocMeta.data[0]._model.radius = 0;
        aocMeta.data[bouData.datasets[0].data.length - 1]._model.radius = 0;

        // Render the chart.
        window.BlogOverviewUsers.render();

        //
        // Users by device pie chart
        //

        // Data
        var ubdData = {
        datasets: [{
            hoverBorderColor: '#ffffff',
            data: @json($orders_items_day),
            backgroundColor: [
            'rgba(0,123,255,0.9)',
            'rgba(0,123,255,0.5)',
            'rgba(0,123,255,0.3)'
            ]
        }],
        labels: @json($orders_items_day_label)
        };

        // Options
        var ubdOptions = {
        legend: {
            position: 'bottom',
            labels: {
            padding: 25,
            boxWidth: 20
            }
        },
        cutoutPercentage: 0,
        // Uncomment the following line in order to disable the animations.
        // animation: false,
        tooltips: {
            custom: false,
            mode: 'index',
            position: 'nearest'
        }
        };

        var ubdCtx = document.getElementsByClassName('items-day')[0];

        // Generate the users by device chart.
        window.ubdChart = new Chart(ubdCtx, {
        type: 'pie',
        data: ubdData,
        options: ubdOptions
        });

    });
})(jQuery);
</script>
@endsection
