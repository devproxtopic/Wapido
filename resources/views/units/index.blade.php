@extends('layouts.admin')

@section('title', 'Unidades')
@section('route_create', url('owners/'. $owner->slug .'/units/create'))

@section('content')

<div class="row">
    <div class="col">
      <div class="card card-small mb-4">
        <div class="card-header border-bottom">
          <h6 class="m-0">Listado</h6>
        </div>
        <div style="overflow-x:auto;" class="card-body p-0 pb-3 text-center">
          <table class="table mb-0">
            <thead class="bg-light">
              <tr>
                <th scope="col" class="border-0">#</th>
                <th scope="col" class="border-0">Nombre</th>
                <th scope="col" class="border-0">Simbolo</th>
                <th scope="col" class="border-0"></th>
              </tr>
            </thead>
            <tbody>

                @foreach ($units as $unit)

                <tr>
                    <td>{{ $unit->id }}</td>
                    <td>{{ $unit->name }}</td>
                    <td>{{ $unit->symbol }}</td>
                    <td>
                        <a href="{{ url('owners/'. $owner->slug . '/units-delete/' . $unit->id) }}" title="Borrar"><i class="fa fa-trash"></i></a>
                        <a href="{{ url('owners/'. $owner->slug . '/units/' . $unit->id. '/edit') }}" title="Editar"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
          </table>
          {{ $units->links() }}
        </div>
      </div>
    </div>
</div>

@endsection
