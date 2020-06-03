@extends('layouts.admin')

@section('title', 'Zonas')
@section('route_create', url('owners/'. $owner->slug .'/locations/create'))

@section('content')

<div class="row">
    <div class="col">
      <div class="card card-small mb-4">
        <div class="card-header border-bottom">
            <h6 class="m-0">Listado</h6>
            {{-- <div class="col text-right view-report">
                <a href="{{ url('owners/'. $owner->slug . '/locations-massive') }}">Crear Másivamente</a>
            </div> --}}
        </div>
        <div class="card-body p-0 pb-3 text-center">
          <table class="table mb-0">
            <thead class="bg-light">
              <tr>
                <th scope="col" class="border-0">#</th>
                <th scope="col" class="border-0">Nombre</th>
                <th scope="col" class="border-0">Ciudad</th>
                <th scope="col" class="border-0">Estado</th>
                <th scope="col" class="border-0">País</th>
                <th scope="col" class="border-0"></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($locations as $location)
                <tr>
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->name }}</td>
                    <td>{{ $location->city->name }}</td>
                    <td>{{ $location->city->state->name }}</td>
                    <td>{{ $location->city->state->country->name }}</td>
                    <td>
                        <a href="{{ url('owners/'. $owner->slug . '/locations-delete/' . $location->id) }}" title="Borrar"><i class="fa fa-trash"></i></a>
                        <a href="{{ url('owners/'. $owner->slug . '/locations/' . $location->id. '/edit') }}" title="Editar"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
          </table>
          {{ $locations->links() }}
        </div>
      </div>
    </div>
</div>

@endsection
