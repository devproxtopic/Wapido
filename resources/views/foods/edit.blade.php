@extends('layouts.admin')

@section('title', 'Actualizar Comida')
@section('display_create', 'display:none;')

@section('content')
<div class="col-sm-12 col-md-12">
    <form method="POST" action="{{ url('owners/'. $owner->slug .'/foods/' . $food->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="category_food_id" class="col-md-4 col-form-label text-md-right">Tipo de Comida</label>

            <div class="col-md-6">
                <select required class="form-control @error('category_food_id') is-invalid @enderror" name="category_food_id" id="category_food_id">
                    <option value="0">Seleccione una opción</option>
                    @foreach($categoryFoods as $cf)
                    <option @if($food->category_food_id == $cf->id) selected @endif value="{{ $cf->id }}">
                    {{ $cf->name }}
                    </option>
                    @endforeach
                </select>

                @error('unit')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $food->name }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="price" class="col-md-4 col-form-label text-md-right">Precio</label>

            <div class="col-md-6">
                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $food->price }}" required autocomplete="price" autofocus>

                @error('price')
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
                <a href="{{ url('owners/'. $owner->slug .'/foods') }}" class="btn btn-warning">
                    Volver
                </a>
            </div>
        </div>
    </form>
</div>
@stop
