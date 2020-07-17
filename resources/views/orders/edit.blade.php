@extends('layouts.admin')

@section('title', 'Actualizar Pedido')
@section('display_create', 'display:none;')

@section('content')
<div class="col-sm-12 col-md-12">
    <form method="POST" action="{{ url('owners/'. $owner->slug .'/orders/' . $order->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="client_id" class="col-md-4 col-form-label text-md-right">Cliente</label>

            <div class="col-md-6">
                <input id="client_id" type="text" readonly class="form-control @error('client_id') is-invalid @enderror"
                value="{{ $order->client->fullname . ' | ' . $order->client->phone }}" required autocomplete="client_id" autofocus>

                @error('client_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="status_id" class="col-md-4 col-form-label text-md-right">Estatus</label>

            <div class="col-md-6">
                <select required class="form-control @error('status_id') is-invalid @enderror" name="status_id" id="status_id">
                    <option value="0">Seleccione una opción</option>
                    @foreach($statuses as $status)
                    <option @if((old('status_id') ?? $order->status_id) == $status->id) selected @endif value="{{ $status->id }}">
                    {{ $status->name }}
                    </option>
                    @endforeach
                </select>

                @error('status_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row confirm_date">
            <label for="confirm_date" class="col-md-4 col-form-label text-md-right">Fecha de Entrega</label>

            <div class="col-md-6">
                <input id="confirm_date" type="date"
                class="form-control @error('confirm_date') is-invalid @enderror"
                name="confirm_date" value="{{ isset($order->confirm_date) ? $order->confirm_date->format('d-m-Y') : now()->format('d-m-Y') }}"
                autocomplete="confirm_date" autofocus>

                @error('confirm_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="total_amount" class="col-md-4 col-form-label text-md-right">Total</label>

            <div class="col-md-6">
                <input id="total_amount" type="text" readonly class="form-control @error('total_amount') is-invalid @enderror" name="total_amount" value="{{ $order->total_amount }}" required autocomplete="total_amount" autofocus>

                @error('total_amount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="field_wrapper">
            <div class="form-group row">
                <label for="measure" class="col-md-4 col-form-label text-md-right">Detalle</label>

                <div class="col-md-6">
                    <table class="table mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=0; @endphp
                            @foreach ($order->details as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->item ? $item->item->name : $item->food->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->unit_price,2) }}</td>
                                    <td>{{ number_format($item->unit_price * $item->quantity,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
                <a href="{{ url('owners/'. $owner->slug .'/orders') }}" class="btn btn-warning">
                    Volver
                </a>
            </div>
        </div>
    </form>
</div>
@stop

@section('scripts')
    <script>
        $(document).ready(function() {
            if($('#status_id').val() != 5){
                $('.confirm_date').hide();
            }

            $('#status_id').change(function(){
                if($(this).val() == 5){
                    $('.confirm_date').show();
                } else {
                    $('.confirm_date').hide();
                }
            });
        });
    </script>
@stop
