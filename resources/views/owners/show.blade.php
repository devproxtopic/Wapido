@extends('layouts.admin')

@section('title', $owner->name)
@section('display_create', 'display:none;')

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
        <div class="card card-small">
            <div class="card-header border-bottom">
                <h6 class="m-0">Bienvenido, administrador de {{ $owner->name }}</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <strong class="text-muted d-block mb-2">Datos Generales</strong>
                            <form method="POST" action="{{ route('owners.update', $owner->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name" class="col-md-6 col-form-label">Nombre</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ $owner->name ?? old('name') }}"
                                        required autocomplete="name" autofocus>
                                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email" class="col-md-6 col-form-label text-md-left">Email</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $owner->email ?? old('email') }}"
                                        required autocomplete="email" autofocus>
                                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="phone" class="col-md-6 col-form-label text-md-left">Teléfono</label>
                                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ $owner->phone ?? old('phone') }}"
                                        required autocomplete="phone" autofocus>
                                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="category_owner_id" class="col-md-6 col-form-label text-md-left">Categoría</label>
                                        <select required class="form-control @error('category_owner_id') is-invalid @enderror"
                                        name="category_owner_id" id="category_owner_id">
                                            <option value="0">Seleccione una opción</option>
                                            @foreach($categories as $category)
                                            <option @if($owner->category_owner_id == $category->id) selected @endif value="{{ $category->id }}">
                                            {{ $category->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('category_owner_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="opening_hours" class="col-md-6 col-form-label text-md-left">Hora de Apertura</label>
                                        <input id="opening_hours" type="time"
                                        class="form-control @error('opening_hours') is-invalid @enderror" name="opening_hours"
                                        value="{{ $owner->opening_hours ?? old('opening_hours') }}"
                                        required autocomplete="opening_hours" autofocus>
                                        @error('opening_hours') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="closing_hours" class="col-md-6 col-form-label text-md-left">Hora de Cierre</label>
                                        <input id="closing_hours" type="time"
                                        class="form-control @error('closing_hours') is-invalid @enderror" name="closing_hours"
                                        value="{{ $owner->closing_hours ?? old('closing_hours') }}"
                                        required autocomplete="closing_hours" autofocus>
                                        @error('closing_hours') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-accent">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
            {{-- <div class="card-body d-flex py-0">
                    <form method="POST" action="{{ route('owners.update', $owner->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">



                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>




                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group">
                </div>

                <div class="form-group">


                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="logo" class="col-md-6 col-form-label text-md-left">Logo</label>
                        <input @if(! $owner) required @endif id="logo" type="file" class="form-control @error('logo') is-invalid @enderror"
                        @isset($owner->logo) vale="{{ \File::get($owner->logo) }}" @endisset
                        name="logo" autofocus>

                        @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group">

                            </div>
                            <div class="form-group">

                            </div>
                            <div class="form-group">

                            </div>
                            <div class="form-group">
                                <label for="description" class="col-md-6 col-form-label text-md-left">Descripción</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                    id="description" cols="30" rows="10">{{ old('description') ?? $owner->description }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
            </div> --}}
            {{--  --}}
        </div>
    </div>
 </div>
@stop

@section('scripts')
@stop
