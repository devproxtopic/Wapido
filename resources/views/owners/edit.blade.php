@extends('layouts.admin')

@section('title', 'Actualizar Negocio')
@section('display_create', 'display:none;')

@section('content')
<div class="row">
    <!-- Sliders -->
    <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
        <div class="card card-small">
            @php
            $sliders = json_decode($owner->sliders);
            $key = 0;
            @endphp
            <div class="card-header border-bottom">
                <h6 class="m-0">Sliders</h6>
            </div>
            <div class="card-body pt-0">
                    <form id="formSliders" method="POST" action="{{ route('update.sliders', $owner->id) }}" enctype="multipart/form-data" class="col-md-12">
                    @csrf
                <div class="row border-bottom py-2 bg-light">
                    <div class="col-12 col-sm-6">
                        <div class="input-group input-group-sm my-auto ml-auto mr-auto ml-sm-auto mr-sm-0" style="max-width: 350px;">
                            <input form="formSliders" type="file" class="input-sm form-control" name="slider_1" id="slider_1">
                            <input form="formSliders" type="file" class="input-sm form-control" name="slider_2" id="slider_2">
                            <input form="formSliders" type="file" class="input-sm form-control" name="slider_3" id="slider_3">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 d-flex mb-2 mb-sm-0">
                        <button form="formSliders" type="submit" class="btn btn-sm btn-white ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0">Actualizar Sliders &rarr;</button>
                    </div>
                </div>
                    </form>
                    @isset($sliders)
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        </ol>
                        <div class="carousel-inner">
                            @foreach($sliders as $key => $slider)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ url($slider) }}" height="500px" class="d-block w-100"  alt="...">
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#myCarousel" role="button"  data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true">     </span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                    </div>
                    @endisset
            </div>
        </div>
    </div>
    <!-- End Sliders -->
    <!-- General Data -->
    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        <div class="card card-small h-100">
            <div class="card-header border-bottom">
                <h6 class="m-0">Datos Generales</h6>
            </div>
            <div class="card-body d-flex py-0">
                @isset($owner->logo)
                <div class="mb-3 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Logo Actual</h5>
                        <img src="{{ url($owner->logo) }}" alt="" class="w-100">
                    </div>
                </div>
                @endisset
            </div>
            <div class="card-body d-flex py-0">
            <form id="updateOwner" method="POST" action="{{ route('owners.update', $owner->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name" class="col-md-6 col-form-label text-md-left">Nombre</label>
                <input form="updateOwner" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $owner->name ?? old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <div class="form-group">
            <label for="email" class="col-md-6 col-form-label text-md-left">Email</label>
                <input form="updateOwner" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $owner->email ?? old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <div class="form-group">
            <label for="phone" class="col-md-6 col-form-label text-md-left">Teléfono</label>
                <input form="updateOwner" id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $owner->phone ?? old('phone') }}" required autocomplete="phone" autofocus>

                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <div class="form-group">
            <label for="logo" class="col-md-6 col-form-label text-md-left">Logo</label>
                <input form="updateOwner" @if(! $owner) required @endif id="logo" type="file" class="form-control @error('logo') is-invalid @enderror"
                @isset($owner->logo) vale="{{ \File::get($owner->logo) }}" @endisset
                name="logo" autofocus>

                @error('logo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
    </div>
            <div class="card-footer border-top">
                <div class="row">
                    <div class="form-group mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-accent">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

    </form>
        </div>
    </div>
    <!-- End General Data -->
    <!-- Ubicación Component -->
    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        <!-- Quick Post -->
        <div class="card card-small h-100">
            <div class="card-header border-bottom">
                <h6 class="m-0">Ubicación</h6>
            </div>
            <div class="card-body d-flex flex-column">
                <form id="ubicationUpdate" method="post" action="{{ route('owner.ubications', $owner->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="country_id" class="col-md-6 col-form-label text-md-left">País</label>
                        <select form="ubicationUpdate" required class="form-control @error('country_id') is-invalid @enderror" name="country_id" id="country_id">
                            <option value="0">Seleccione una opción</option>
                            @foreach($countries as $country)
                                <option @if($owner->country_id == $country->id) selected @endif value="{{ $country->id }}">
                                {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="state_id" class="col-md-6 col-form-label text-md-left">Estado</label>
                        <select form="ubicationUpdate" required class="form-control @error('state_id') is-invalid @enderror" name="state_id" id="state_id">
                            <option value="0">Seleccione una opción</option>
                            @isset($owner->country_id)
                            @foreach($countries->find($owner->country_id)->states as $state)
                                <option @if($owner->state_id == $state->id) selected @endif value="{{ $state->id }}">
                                {{ $state->name }}
                                </option>
                            @endforeach
                            @endisset

                            {{-- SE LLENA CON AJAX--}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city_id" class="col-md-6 col-form-label text-md-left">Ciudad</label>
                        <select form="ubicationUpdate" required class="form-control @error('city_id') is-invalid @enderror" name="city_id" id="city_id">
                            <option value="0">Seleccione una opción</option>
                            @isset($owner->state_id)
                            @foreach($countries->find($owner->country_id)->states->find($owner->state_id)->cities as $city)
                                <option @if($owner->city_id == $city->id) selected @endif value="{{ $city->id }}">
                                {{ $city->name }}
                                </option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="location_id" class="col-md-6 col-form-label text-md-left">Zona</label>
                        <select form="ubicationUpdate" required class="form-control @error('location_id') is-invalid @enderror" name="location_id" id="location_id">
                            <option value="0">Seleccione una opción</option>
                            @isset($owner->city_id)
                            @foreach($countries->find($owner->country_id)->states->find($owner->state_id)->cities->find($owner->city_id)->locations as $location)
                                <option @if($owner->location_id == $location->id) selected @endif value="{{ $location->id }}">
                                {{ $location->name }}
                                </option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <button form="ubicationUpdate" type="submit" class="btn btn-accent">Guardar</button>
                        <a href="{{ url('home') }}" class="btn btn-primary">Volver</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Quick Post -->
    </div>
    <!-- End Ubicación Component -->
        <!-- Negocio Component -->
    <div class="col-lg-8 col-md-10 col-sm-12 mb-4">
        <!-- Quick Post -->
        <div class="card card-small h-100">
            <div class="card-header border-bottom">
                <h6 class="m-0">Datos del Negocio</h6>
            </div>
            <div class="card-body d-flex flex-column">
                <form id="ownerDataUpdate" method="post" action="{{ route('owners.update', $owner->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="category_owner_id" class="col-md-6 col-form-label text-md-left">Categoría</label>
                        <select form="ownerDataUpdate" required class="form-control @error('category_owner_id') is-invalid @enderror" name="category_owner_id" id="category_owner_id">
                            <option value="0">Seleccione una opción</option>
                            @foreach($categories as $category)
                                <option @if($owner->category_owner_id == $category->id) selected @endif value="{{ $category->id }}">
                                {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="opening_hours" class="col-md-6 col-form-label text-md-left">Hora de Apertura</label>
                        <input form="ownerDataUpdate" id="opening_hours" type="time"
                        class="form-control @error('opening_hours') is-invalid @enderror" name="opening_hours"
                        value="{{ $owner->opening_hours ?? old('opening_hours') }}" required autocomplete="phone" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="closing_hours" class="col-md-6 col-form-label text-md-left">Hora de Cierre</label>
                        <input form="ownerDataUpdate" id="closing_hours" type="time"
                        class="form-control @error('closing_hours') is-invalid @enderror" name="closing_hours"
                        value="{{ $owner->closing_hours ?? old('closing_hours') }}" required autocomplete="phone" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-6 col-form-label text-md-left">Descripción</label>
                            <textarea form="updateOwner" name="description" class="form-control @error('description') is-invalid @enderror"
                            id="description" cols="30" rows="10">{{ old('description') ?? $owner->description }}</textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group mb-0">
                        <button form="ownerDataUpdate" type="submit" class="btn btn-accent">Guardar</button>
                        <a href="{{ url('home') }}" class="btn btn-primary">Volver</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Quick Post -->
    </div>
    <!-- End Negocio Component -->
</div>
{{-- <div class="col-sm-12 col-md-12">
    <form method="POST" action="{{ route('owners.update', $owner->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name" class="col-md-6 col-form-label text-md-left">Nombre</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $owner->name ?? old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-md-6 col-form-label text-md-left">Email</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $owner->email ?? old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class="col-md-6 col-form-label text-md-left">Teléfono</label>

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

        <div class="form-group">
            <label for="logo" class="col-md-6 col-form-label text-md-left">Logo</label>

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

        <div class="form-group">
            <label for="slider_1" class="col-md-6 col-form-label text-md-left">Slider 1</label>

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
        @endisset

        <div class="form-group">
            <label for="slider_2" class="col-md-6 col-form-label text-md-left">Slider 2</label>

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
        @endisset

        <div class="form-group">
            <label for="slider_3" class="col-md-6 col-form-label text-md-left">Slider 3</label>

            <div class="col-md-6">
                <input id="slider_3" type="file" class="form-control @error('slider_3') is-invalid @enderror"
                @isset($sliders[2]) vale="{{ \File::get($sliders[2]) }}" @endisset
                name="slider_3" autofocus>

                @error('slider_3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-md-6 col-form-label text-md-left">Descripción</label>

            <div class="col-md-6">
                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                id="description" cols="30" rows="10">{{ old('description') ?? $owner->description }}</textarea>

                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
                <a href="{{ url('/home') }}" class="btn btn-warning">
                    Volver
                </a>
            </div>
        </div>
    </form>
</div> --}}
@stop

@section('scripts')
<script src="{{ asset('js/ajax/locations.js') }}"></script>
@stop
