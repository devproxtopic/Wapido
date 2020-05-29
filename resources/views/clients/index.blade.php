@extends('layouts.admin')

@section('title', 'Clientes')
@section('route_create', url('owners/'. $owner->slug .'/clients/create'))

@section('content')

<div class="row">
    <div class="col">
      <div class="card card-small mb-4">
        <div class="card-header border-bottom">
          <h6 class="m-0">Listado</h6>
        </div>
        <div class="card-body p-0 pb-3 text-center">
          <table class="table mb-0">
            <thead class="bg-light">
              <tr>
                <th scope="col" class="border-0">#</th>
                <th scope="col" class="border-0">Nombre y Apellido</th>
                <th scope="col" class="border-0">Teléfono</th>
                <th scope="col" class="border-0">Correo</th>
                <th scope="col" class="border-0"></th>
              </tr>
            </thead>
            <tbody>

                @foreach ($clients as $client)

                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->fullname }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->email }}</td>
                    <td>
                        <a href="{{ url('owners/'. $owner->slug . '/clients-delete/' . $client->id) }}" title="Borrar"><i class="fa fa-trash"></i></a>
                        <a href="{{ url('owners/'. $owner->slug . '/clients/' . $client->id. '/edit') }}" title="Editar"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
          </table>
          {{ $clients->links() }}
        </div>
      </div>
    </div>
</div>

@endsection
