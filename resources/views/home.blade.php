@extends('layouts.admin')

@section('title', 'Negocios Asociados')
@section('route_create', route('owners.create'))

@section('content')
<div class="row">
    @foreach ($owners as $owner)
    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="card card-small card-post card-post--1">
            <div class="card-post__image" style="background-image: url('{{ asset($owner->logo) }}');">
                <a href="{{ route('owners.edit', $owner->id) }}" class="card-post__category badge badge-pill badge-dark">Editar</a>
                <div class="card-post__author d-flex">
                    <a href="{{ route('owners.show', $owner->id) }}" class="card-post__author-avatar card-post__author-avatar--small"></a>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    <a class="text-fiord-blue" href="{{ route('owners.show', $owner->id) }}">{{ $owner->name }}</a>
                </h5>
                <p class="card-text d-inline-block mb-3">{{ $owner->description }}</p>
                <span class="text-muted">{{ $owner->email }}</span><br>
                <a class="text-primary" href="{{ url('/'. $owner->slug) }}">Ir al negocio ({{ url('/'. $owner->slug) }})</a><br>
                <a href="{{ route('owners.destroy', $owner->id) }}">Borrar <i class="fa fa-trash"></i></a>
            </div>
        </div>
    </div>
    @endforeach
 </div>
@stop

@section('scripts')
@stop
