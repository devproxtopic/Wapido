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
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="theme" class="col-md-6 col-form-label text-md-left">Tema</label>
                                        <select class="form-control @error('theme') is-invalid @enderror"
                                        name="theme" id="theme">
                                            <option value="0">Seleccione una opción</option>
                                            <option @if($owner->theme == '') selected @endif value="">Sin Tema (Tema por Defecto)</option>
                                            <option @if($owner->theme == 'dark') selected @endif value="dark">Tema Oscuro</option>
                                            <option @if($owner->theme == 'dark globo') selected @endif value="dark globo">Tema Oscuro Globo</option>
                                            <option @if($owner->theme == 'dark red') selected @endif value="dark red">Tema Oscuro Rojo</option>
                                            <option @if($owner->theme == 'purple') selected @endif value="purple">Tema Purpura</option>
                                            <option @if($owner->theme == 'orange') selected @endif value="orange">Tema Naranja</option>
                                            <option @if($owner->theme == 'gray') selected @endif value="gray">Tema Gris</option>
                                            <option @if($owner->theme == 'rose') selected @endif value="rose">Tema Rosado</option>
                                            <option @if($owner->theme == 'blue') selected @endif value="blue">Tema Azul</option>
                                            <option @if($owner->theme == 'green') selected @endif value="green">Tema Verde</option>
                                            <option @if($owner->theme == 'sunset') selected @endif value="sunset">Tema Atardecer</option>
                                            <option @if($owner->theme == 'simple') selected @endif value="simple">Tema Simple</option>
                                            <option @if($owner->theme == 'yellow') selected @endif value="yellow">Tema Amarillo</option>
                                            <option @if($owner->theme == 'dawn') selected @endif value="dawn">Tema Amanecer</option>
                                        </select>
                                        @error('theme') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
        </div>
    </div>
</div>
@stop

@section('scripts')
@stop
