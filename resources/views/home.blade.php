@extends('layouts.admin')

@section('title', 'Negocios Asociados')
@section('display_create', 'display:none;')

@section('content')
@switch(Auth::user()->rol_id)
    @case(1)
        @include('home_sections.admin')
        @break
    @case(2)
    @case(3)
        @include('home_sections.employees')
        @break
    @default
        @include('home_sections.owner')
@endswitch
@stop

@section('scripts')
@stop
