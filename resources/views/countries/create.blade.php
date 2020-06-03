@extends('layouts.admin')

@section('title', 'Crear Pais')
@section('display_create', 'display:none;')

@section('content')
<div class="col-sm-12 col-md-12">
    <form method="POST" action="{{ url('owners/'. $owner->slug .'/countries') }}" enctype="multipart/form-data">
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
            <label for="phone_prefix" class="col-md-4 col-form-label text-md-right">Prefijo Telefónico</label>

            <div class="col-md-6">
                <input id="phone_prefix" type="text" class="form-control @error('phone_prefix') is-invalid @enderror" name="phone_prefix" value="{{ old('phone_prefix') }}" required autocomplete="phone_prefix" autofocus>

                @error('phone_prefix')
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
                <a href="{{ url('owners/'. $owner->slug .'/countries') }}" class="btn btn-warning">
                    Volver
                </a>
            </div>
        </div>
    </form>
</div>
@stop
