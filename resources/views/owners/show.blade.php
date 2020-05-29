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
        </div>
    </div>
 </div>
@stop

@section('scripts')
@stop
