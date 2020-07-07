@extends('layouts.admin')

@section('title', 'Actualizar Mesa')
@section('display_create', 'display:none;')

@section('content')
<div class="col-sm-12 col-md-12">
    <form method="POST" action="{{ url('owners/'. $owner->slug .'/tables' . $table->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="number" class="col-md-4 col-form-label text-md-right">Número de mesa</label>

            <div class="col-md-6">
                <input id="number" readonly type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ $table->number }}" required autocomplete="number" autofocus>

                @error('number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="ubication" class="col-md-4 col-form-label text-md-right">Ubicación</label>

            <div class="col-md-6">
                <input id="ubication" type="text" class="form-control @error('ubication') is-invalid @enderror" name="ubication" value="{{ $table->ubication }}" required autocomplete="ubication" autofocus>

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
                    <option {{ $table->type == 1 ? 'selected' : '' }} value="1">No Fumadores</option>
                    <option {{ $table->type == 2 ? 'selected' : '' }} value="2">Con Niños</option>
                    <option {{ $table->type == 3 ? 'selected' : '' }} value="3">Indistinto</option>
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
