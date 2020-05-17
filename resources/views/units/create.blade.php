@extends('layouts.admin')

@section('title', 'Crear Unidad')
@section('display_create', 'display:none;')

@section('content')
<div class="col-sm-12 col-md-12">
    <form method="POST" action="{{ route('units.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="symbol" class="col-md-4 col-form-label text-md-right">Simbolo</label>

            <div class="col-md-6">
                <input id="symbol" type="text" class="form-control @error('symbol') is-invalid @enderror" name="symbol" value="{{ old('symbol') }}" required autocomplete="symbol" autofocus>

                @error('symbol')
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
                <a href="{{ url('/units') }}" class="btn btn-warning">
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
