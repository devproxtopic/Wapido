@extends('layouts.admin')

@section('title', 'Actualizar Cliente')
@section('display_create', 'display:none;')

@section('content')
<div class="col-sm-12 col-md-12">
    <form method="POST" action="{{ url('owners/'. $owner->slug .'/clients/' . $client->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="fullname" class="col-md-4 col-form-label text-md-right">Nombre y Apellido</label>

            <div class="col-md-6">
                <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') ?? $client->fullname }}" required autocomplete="fullname" autofocus>

                @error('fullname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="phone" class="col-md-4 col-form-label text-md-right">Teléfono</label>

            <div class="col-md-6">
                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $client->phone }}" required autocomplete="phone" autofocus>

                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Correo</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $client->email }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="address" class="col-md-4 col-form-label text-md-right">Dirección</label>

            <div class="col-md-6">
                <textarea required name="address" class="form-control @error('address') is-invalid @enderror"
                id="address" cols="30" rows="10">{{ old('address') ?? $client->address }}</textarea>

                @error('address')
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
                <a href="{{ url('owners/'. $owner->slug .'/clients') }}" class="btn btn-warning">
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
        var measures = @json($measures);

    if(measures){
        for (let index = 0; index < measures.length; index++) {

            var wrapper = $('.field_wrapper'); // Contenedor de campos
            var fieldHTML = '<div class="form-group row">'+
                    '<label for="measure" class="col-md-4 col-form-label text-md-right">Medida / Cantidad</label>'+
                    '<div class="col-md-6">'+
                    '<input type="text" class="form-control @error("measure") is-invalid @enderror" name="measure[]" required value="' + measures[index] + '">'+
                    '</div>'+
                    '<a href="javascript:void(0);" class="remove_button" title="Borrar"><i class="fa fa-trash"></i></div>';

            $(wrapper).append(fieldHTML); // Añadimos el HTML

        }
    }


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
