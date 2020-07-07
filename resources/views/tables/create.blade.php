@extends('layouts.admin')

@section('title', 'Crear Mesas')
@section('display_create', 'display:none;')

@section('content')
<div class="col-sm-12 col-md-12">
    <form method="POST" action="{{ url('owners/'. $owner->slug .'/tables') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="quantity" class="col-md-4 col-form-label text-md-right">Número de mesas</label>

            <div class="col-md-6">
                <input id="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required autocomplete="quantity" autofocus>

                @error('quantity')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="ubication" class="col-md-4 col-form-label text-md-right">Ubicación</label>

            <div class="col-md-6">
                <input id="ubication" type="text" class="form-control @error('ubication') is-invalid @enderror" name="ubication" value="{{ old('ubication') }}" required autocomplete="ubication" autofocus>

                @error('ubication')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="type" class="col-md-4 col-form-label text-md-right">Tipo</label>

            <div class="col-md-6">
                <select id="type" class="form-control @error('type') is-invalid @enderror"
                name="type" required autofocus>
                    <option value="">Seleccione una opción</option>
                    <option value="1">No Fumadores</option>
                    <option value="2">Con Niños</option>
                    <option value="3">Indistinto</option>
                </select>

                @error('type')
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
                <a href="{{ url('owners/'. $owner->slug .'/tables') }}" class="btn btn-warning">
                    Volver
                </a>
            </div>
        </div>
    </form>
</div>
@stop

@section('scripts')
@stop
