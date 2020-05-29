@extends('layouts.admin')

@section('title', 'Actualizar Producto')
@section('display_create', 'display:none;')

@section('content')
<div class="col-sm-12 col-md-12">
    <form method="POST" action="{{ url('owners/'. $owner->slug .'/items/' . $item->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $item->name }}" required autocomplete="name" autofocus>

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
                id="description" cols="30" rows="10">{{ old('description') ?? $item->description }}</textarea>

                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="category_id" class="col-md-4 col-form-label text-md-right">Categoría</label>

            <div class="col-md-6">
                <select required class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                    <option value="0">Seleccione una opción</option>
                    @foreach($categories as $category)
                    <option @if((old('category_id') ?? $item->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                    {{ $category->name }}
                    </option>
                    @endforeach
                </select>

                @error('category_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="field_wrapper">

            {{-- SE LLENA CON AJAX --}}

        </div>

        <div class="mb-3 text-center">
            <div class="card-body">
                <h5 class="card-title">Imagen Actual</h5>
                <img src="{{ url('storage/' . $item->img) }}" alt="" width="50%">
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
                <a href="{{ url('owners/'. $owner->slug .'/items') }}" class="btn btn-warning">
                    Volver
                </a>
            </div>
        </div>
    </form>
</div>
@stop

@section('scripts')
<script src="{{ asset('js/ajax/items.js') }}"></script>
<script>
    $(document).ready(function(){
        var prices = @json($prices);

    if(prices){
        for (let index = 0; index < prices.length; index++) {

            var wrapper = $('.field_wrapper'); // Contenedor de campos
            var fieldHTML = '<div class="form-group row">'+
                        '<div class="col-md-6 offset-md-4">'+
                        '<div class="row">'+
                            '<label for="quantity" class="col-form-label text-md-right">Cantidad</label>'+
                            '<div class="col-md-4">'+
                                '<input readonly type="text" class="form-control" name="quantity[]" required value="'+prices[index]['quantity']+'">'+
                            '</div>'+
                            '<label for="price" class="col-form-label text-md-right">Precio</label>'+
                            '<div class="col-md-4">'+
                                '<input type="number" class="form-control @error("price") is-invalid @enderror" name="price[]" required value="'+prices[index]['price']+'">'+
                            '</div>'+
                        '</div>'+
                        '</div>'+
                    '</div>';

            $(wrapper).append(fieldHTML); // Añadimos el HTML

        }
    }
});
</script>
@stop
