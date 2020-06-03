@extends('layouts.admin')

@section('title', 'Crear Estado')
@section('display_create', 'display:none;')

@section('content')
<div class="col-sm-12 col-md-12">
    <form method="POST" action="{{ url('owners/'. $owner->slug .'/states') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="country_id" class="col-md-4 col-form-label text-md-right">País</label>

            <div class="col-md-6">
                <select required class="form-control @error('country_id') is-invalid @enderror" name="country_id" id="country_id">
                    <option value="0">Seleccione una opción</option>
                    @foreach($countries as $country)
                    <option @if(old('country_id') == $country->id) selected @endif value="{{ $country->id }}">
                    {{ $country->name }}
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
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
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
                <a href="{{ url('owners/'. $owner->slug .'/states') }}" class="btn btn-warning">
                    Volver
                </a>
            </div>
        </div>
    </form>
</div>
@stop

@section('scripts')
<script src="{{ asset('js/ajax/locations.js') }}"></script>
@stop
