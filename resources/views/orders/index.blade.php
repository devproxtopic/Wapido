@extends('layouts.admin')

@section('title', 'Pedidos')
@section('display_create', 'display:none;')

@section('content')
<div class="row">
    <div class="col">
    <div class="card card-small mb-4">
        <div class="card-header border-bottom">
        <h6 class="m-0">Filtrar por</h6>
        </div>
        <div style="overflow-x:auto;" class="card-body p-0 pb-3 text-center">
            <form method="POST" action="{{ url('owners/'. $owner->slug .'/orders') }}" class="col-md-12">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="date_created_filter" class="col-form-label text-md-left">Fecha de creación</label>
                        <input id="date_created_filter" type="date"
                        class="form-control @error('date_created_filter') is-invalid @enderror" name="date_created_filter"
                        value="{{ isset($date_created_filter) ? $date_created_filter : old('date_created_filter') }}" autofocus>
                        @error('date_created_filter') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="client_filter" class="col-form-label text-md-left">Cliente (Nombre o Teléfono)</label>
                        <input id="client_filter" type="text"
                        class="form-control @error('client_filter') is-invalid @enderror" name="client_filter"
                        value="{{ isset($client_filter) ? $client_filter : old('client_filter') }}" autofocus>
                        @error('client_filter') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="status_filter" class="col-form-label text-md-left">Estado</label>
                        <select class="form-control @error('status_filter') is-invalid @enderror"
                        name="status_filter" id="status_filter">
                            <option value="">Seleccione una opción</option>
                            @foreach (App\Models\Status::all() as $item)
                                <option {{ isset($status_filter) && $status_filter == $item->id ? ' selected ' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('status_filter') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-accent">Buscar</button>
                    <a href="{{ url('owners/'. $owner->slug .'/orders') }}" class="btn btn-primary">Resetear</a>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>

<div class="row">
    <div class="col">
    <div class="card card-small mb-4">
        <div class="card-header border-bottom">
        <h6 class="m-0">Listado</h6>
        </div>
        <div style="overflow-x:auto;" class="card-body p-0 pb-3 text-center">
        <table class="table mb-0">
            <thead class="bg-light">
            <tr>
                <th scope="col" class="border-0">#</th>
                <th scope="col" class="border-0">Cliente</th>
                <th scope="col" class="border-0">Estado</th>
                <th scope="col" class="border-0">Total</th>
                <th scope="col" class="border-0">Fecha y Hora</th>
                <th scope="col" class="border-0"></th>
            </tr>
            </thead>
            <tbody>

                @foreach ($orders as $order)

                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->client->fullname }}</td>
                    <td>{{ $order->status->name }}</td>
                    <td>{{ number_format($order->total_amount, 2) }}</td>
                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <a href="{{ url('owners/'. $owner->slug . '/orders/' . $order->id. '/edit') }}" title="Editar"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        {{ $orders->links() }}
        </div>
    </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/modal.js') }}"></script>
@endsection
