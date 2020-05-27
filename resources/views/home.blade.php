@extends('layouts.admin')

@section('title', 'Detalles de Configuración')
@section('display_create', 'display:none;')

@section('content')
<div class="col-sm-12 col-md-12">
    <form method="POST" action="{{ url('/owners') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $owner->name ?? old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $owner->email ?? old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="phone" class="col-md-4 col-form-label text-md-right">Teléfono</label>

            <div class="col-md-6">
                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $owner->phone ?? old('phone') }}" required autocomplete="phone" autofocus>

                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        @isset($owner->logo)
        <div class="mb-3 text-center">
            <div class="card-body">
                <h5 class="card-title">Logo Actual</h5>
                <img src="{{ url($owner->logo) }}" alt="" width="50%">
            </div>
        </div>
        @endisset

        <div class="form-group row">
            <label for="logo" class="col-md-4 col-form-label text-md-right">Logo</label>

            <div class="col-md-6">
                <input @if(! $owner) required @endif id="logo" type="file" class="form-control @error('logo') is-invalid @enderror"
                @isset($owner->logo) vale="{{ \File::get($owner->logo) }}" @endisset
                name="logo" autofocus>

                @error('logo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        @php
           isset($owner) ? $sliders = json_decode($owner->sliders) : $sliders = array();
        @endphp

        @isset($sliders[0])
        <div class="mb-3 text-center">
            <div class="card-body">
                <h5 class="card-title">Slider 1 Actual</h5>
                <img src="{{ url($sliders[0]) }}" alt="" width="50%">
            </div>
        </div>
        @endisset

        <div class="form-group row">
            <label for="slider_1" class="col-md-4 col-form-label text-md-right">Slider 1</label>

            <div class="col-md-6">
                <input  @if(! $owner) required @endif id="slider_1" type="file" class="form-control @error('slider_1') is-invalid @enderror"
                @isset($sliders[0]) vale="{{ \File::get($sliders[0]) }}" @endisset
                name="slider_1" autofocus>

                @error('slider_1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        @isset($sliders[1])
        <div class="mb-3 text-center">
            <div class="card-body">
                <h5 class="card-title">Slider 2 Actual</h5>
                <img src="{{ url($sliders[1]) }}" alt="" width="50%">
            </div>
        </div>

        <input type="hidden" name="slider_2" value="{{ \File::get($sliders[1]) }}">
        @endisset

        <div class="form-group row">
            <label for="slider_2" class="col-md-4 col-form-label text-md-right">Slider 2</label>

            <div class="col-md-6">
                <input @if(! $owner) required @endif id="slider_2" type="file" class="form-control @error('slider_2') is-invalid @enderror"
                @isset($sliders[1]) vale="{{ \File::get($sliders[1]) }}" @endisset
                name="slider_2" autofocus>

                @error('slider_2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        @isset($sliders[2])
        <div class="mb-3 text-center">
            <div class="card-body">
                <h5 class="card-title">Slider 3 Actual</h5>
                <img src="{{ url($sliders[2]) }}" alt="" width="50%">
            </div>
        </div>

        <input type="hidden" name="slider_3" value="{{ \File::get($sliders[2]) }}">
        @endisset

        <div class="form-group row">
            <label for="slider_3" class="col-md-4 col-form-label text-md-right">Slider 3</label>

            <div class="col-md-6">
                <input id="slider_3" type="file" class="form-control @error('slider_3') is-invalid @enderror"
                name="slider_3" autofocus>

                @error('slider_3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Actualizar
                </button>
            </div>
        </div>
    </form>
</div>
@stop

@section('scripts')
@stop
