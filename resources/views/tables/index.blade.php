@extends('layouts.admin')

@section('title', 'Mesas')
@section('route_create', url('owners/'. $owner->slug .'/tables/create'))

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
                <th scope="col" class="border-0">Ubicación</th>
                <th scope="col" class="border-0">QR</th>
                <th scope="col" class="border-0"></th>
              </tr>
            </thead>
            <tbody>

                @foreach ($tables as $table)

                <tr>
                    <td>{{ $table->number }}</td>
                    <td>{{ $table->ubication }}</td>
                    <td><img src="{{ asset($table->qr) }}"></td>
                    <td>
                        <a href="{{ url('owners/'. $owner->slug . '/tables-delete/' . $table->id) }}" title="Borrar"><i class="fa fa-trash"></i></a>
                        <a href="{{ url('owners/'. $owner->slug . '/tables/' . $table->id. '/edit') }}" title="Editar"><i class="fa fa-edit"></i></a>
                        <a href="{{ url('owners/'. $owner->slug . '/tables/' . $table->id. '/download') }}" title="Descargar"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
          </table>
          {{ $tables->links() }}
        </div>
      </div>
    </div>
</div>

@endsection
