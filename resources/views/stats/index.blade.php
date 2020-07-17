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
        new Chart(document.getElementsByClassName('items-range-month')[0], {
            type: 'bar',
            data: {
            labels: @json($orders_items_month_label),
            datasets: [
                {
                label: "Cantidad",
                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850",
                                "#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850",
                                "#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                data: @json($orders_items_month)
                }
            ]
            },
            options: {
            legend: { display: false },
            title: {
                display: false,
                text: 'Ventas de productos en el mes'
            }
            }
        });

        new Chart(document.getElementsByClassName('items-day')[0], {
            type: 'pie',
            data: {
            labels: @json($orders_items_day_label),
            datasets: [{
                label: "Cantidad",
                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850",
                            "#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#3e95cd",
                            "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                data: @json($orders_items_day)
            }]
            },
            options: {
                title: {
                    display: false,
                    text: 'Ventas de productos en el día'
                }
            }
        });
    });
})(jQuery);
</script>
@endsection
