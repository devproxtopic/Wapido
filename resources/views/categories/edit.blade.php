@extends('layouts.admin')

@section('title', 'Actualizar Categoría')
@section('display_create', 'display:none;')

@section('content')
<div class="col-sm-12 col-md-12">
    <form method="POST" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $category->name }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>

            <div class="col-md-6">
                <textarea required name="description" class="form-control @error('description') is-invalid @enderror"
                id="description" cols="30" rows="10">{{ old('description') ?? $category->description }}</textarea>

                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="unit_id" class="col-md-4 col-form-label text-md-right">Unidad</label>

            <div class="col-md-6">
                <select required class="form-control @error('unit_id') is-invalid @enderror" name="unit_id" id="unit_id">
                    <option value="0">Seleccione una opción</option>
                    @foreach($units as $unit)
                    <option @if((old('unit') ?? $category->unit_id) == $unit->id) selected @endif value="{{ $unit->id }}">
                    {{ $unit->name . ' - ' . $unit->symbol }}
                    </option>
                    @endforeach
                </select>

                @error('unit_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="field_wrapper">
            <div class="form-group row">
                <label for="measure" class="col-md-4 col-form-label text-md-right">Medida / Cantidad</label>

                <div class="col-md-6">
                    <input type="text" class="form-control @error('measure') is-invalid @enderror" name="measure[]">

                    <a href="javascript:void(0);" class="add_button" title="Añadir">Añadir otra medida</a>

                    @error('measure')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3 text-center">
            <div class="card-body">
                <h5 class="card-title">Imagen Actual</h5>
                <img src="{{ url('storage/' . $category->img) }}" alt="" width="50%">
            </div>
        </div>

        <div class="form-group row">
            <label for="file" class="col-md-4 col-form-label text-md-right">Imagen</label>

            <div class="col-md-6">
                <input id="file" type="file" class="form-control @error('file') is-invalid @enderror"
                name="file" autofocus>

                @error('file')
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
                <a href="{{ url('/categories') }}" class="btn btn-warning">
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
