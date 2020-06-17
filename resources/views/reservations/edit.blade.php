@extends('layouts.admin')

@section('title', 'Actualizar Reservación')
@section('display_create', 'display:none;')

@section('content')
<div class="col-sm-12 col-md-12">
    <form method="POST" action="{{ url('owners/'. $owner->slug .'/reservations/' . $reservation->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="client_id" class="col-md-4 col-form-label text-md-right">Cliente</label>

            <div class="col-md-6">
                <input id="client_id" type="text" readonly class="form-control @error('client_id') is-invalid @enderror" name="client_id" value="{{ $reservation->client->fullname . ' | ' . $reservation->client->phone }}" required autocomplete="client_id" autofocus>

                @error('client_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="confirmed" class="col-md-4 col-form-label text-md-right">Confirmado</label>

            <div class="col-md-6">
                <select required class="form-control @error('confirmed') is-invalid @enderror" name="confirmed" id="confirmed">
                    <option @if((old('confirmed') ?? $reservation->confirmed) == 1) selected @endif value="1">Sí</option>
                    <option @if((old('confirmed') ?? $reservation->confirmed) == 0) selected @endif value="0">No</option>
                </select>

                @error('confirmed')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="date" class="col-md-4 col-form-label text-md-right">Fecha</label>

            <div class="col-md-6">
                <input id="date" type="text" readonly class="form-control @error('date') is-invalid @enderror" name="date" value="{{ $reservation->date }}" required autocomplete="date" autofocus>

                @error('date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="start_time" class="col-md-4 col-form-label text-md-right">Hora de Inicio</label>

            <div class="col-md-6">
                <input id="start_time" type="text" readonly class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{ $reservation->start_time }}" required autocomplete="start_time" autofocus>

                @error('start_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="memo" class="col-md-4 col-form-label text-md-right">Notas</label>

            <div class="col-md-6">
                <textarea required name="memo" class="form-control @error('memo') is-invalid @enderror"
                id="memo" cols="30" rows="10">{{ old('memo') ?? $reservation->memo }}</textarea>

                @error('memo')
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
                <a href="{{ url('owners/'. $owner->slug .'/reservations/') }}" class="btn btn-warning">
                    Volver
                </a>
            </div>
        </div>
    </form>
</div>
@stop
