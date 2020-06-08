@extends('layouts.admin')

@section('title', 'Actualizar Categoria de Comida')
@section('display_create', 'display:none;')

@section('content')
<div class="col-sm-12 col-md-12">
    <form method="POST" action="{{ url('owners/'. $owner->slug .'/categories-food/' . $category_food->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $category_food->name }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="mb-3 text-center">
            <div class="card-body">
                <h5 class="card-title">Imagen Actual</h5>
                <img src="{{ url('storage/' . $category_food->picture) }}" alt="" width="50%">
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
                <a href="{{ url('owners/'. $owner->slug .'/categories-food') }}" class="btn btn-warning">
                    Volver
                </a>
            </div>
        </div>
    </form>
</div>
@stop
