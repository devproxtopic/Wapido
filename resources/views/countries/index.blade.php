@extends('layouts.admin')

@section('title', 'Paises')
@section('route_create', url('owners/'. $owner->slug .'/countries/create'))

@section('content')

<div class="row">
    <div class="col">
      <div class="card card-small mb-4">
        <div class="card-header border-bottom">
            <h6 class="m-0">Listado</h6>
            {{-- <div class="col text-right view-report">
                <a href="{{ url('owners/'. $owner->slug . '/countries-massive') }}">Crear Másivamente</a>
            </div> --}}
        </div>
        <div style="overflow-x:auto;" class="card-body p-0 pb-3 text-center">
          <table class="table mb-0">
            <thead class="bg-light">
              <tr>
                <th scope="col" class="border-0">#</th>
                <th scope="col" class="border-0">Nombre</th>
                <th scope="col" class="border-0">Prefijo Telefónico</th>
                <th scope="col" class="border-0"></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($countries as $country)
                <tr>
                    <td>{{ $country->id }}</td>
                    <td>{{ $country->name }}</td>
                    <td>{{ $country->phone_prefix }}</td>
                    <td>
                        <a href="{{ url('owners/'. $owner->slug . '/countries-delete/' . $country->id) }}" title="Borrar"><i class="fa fa-trash"></i></a>
                        <a href="{{ url('owners/'. $owner->slug . '/countries/' . $country->id. '/edit') }}" title="Editar"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
          </table>
          {{ $countries->links() }}
        </div>
      </div>
    </div>
</div>

@endsection
