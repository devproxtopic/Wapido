@extends('layouts.admin')

@section('title', 'Crear Pedido')
@section('display_create', 'display:none;')

@section('content')
<div class="col-sm-12 col-md-12">
    <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="client_id" class="col-md-4 col-form-label text-md-right">Cliente</label>

            <div class="col-md-6">
                <select required class="form-control @error('client_id') is-invalid @enderror" name="client_id" id="client_id">
                    <option value="0">Seleccione una opción</option>
                    @foreach($clients as $client)
                    <option @if(old('client_id') == $client->id) selected @endif value="{{ $client->id }}">
                    {{ $client->fullname }}
                    </option>
                    @endforeach
                </select>

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
                    <option @if(old('status_id') == $status->id) selected @endif value="{{ $status->id }}">
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

        <div class="form-group row">
            <label for="total_amount" class="col-md-4 col-form-label text-md-right">Total del pedido</label>

            <div class="col-md-6">
                <input id="total_amount" type="text" class="form-control @error('total_amount') is-invalid @enderror" total_amount="total_amount" value="{{ old('total_amount') }}" required autocomplete="total_amount" autofocus>

                @error('total_amount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
                <a href="{{ url('/orders') }}" class="btn btn-warning">
                    Volver
                </a>
            </div>
        </div>
    </form>
</div>
@stop

@section('scripts')
<script>
    $(document).ready(function(){
        var maxField = 10; // Numero maximo de campos
        var addButton = $('.add_button'); // Selector del boton de Insertar
        var wrapper = $('.field_wrapper'); // Contenedor de campos
        var fieldHTML = '<div class="form-group row">'+
                    '<label for="measure" class="col-md-4 col-form-label text-md-right">Medida / Cantidad</label>'+
                    '<div class="col-md-6">'+
                    '<input type="text" class="form-control @error("measure") is-invalid @enderror" name="measure[]" required>'+
                    '</div>'+
                    '<a href="javascript:void(0);" class="remove_button" title="Borrar"><i class="fa fa-trash"></i></div>'; //New input field html
        var x = 1; // Iniciamos el contador a 1
        $(addButton).click(function(){ // Una vez que se haga clic en el boton
            if(x < maxField){ //Comprobamos el maximo
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); // Añadimos el HTML
            }
        });
        $(wrapper).on('click', '.remove_button', function(e){ // Una vez se ha hecho clic en el boton de eliminar
            e.preventDefault();
            $(this).parent('div').remove(); //Eliminamos el div
            x--; // Reducimos el contador a 1
        });
    });
</script>
@stop
