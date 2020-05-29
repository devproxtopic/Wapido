@extends('layouts.admin')

@section('title', 'Promociones')
@section('route_create', url('owners/'. $owner->slug .'/promotions/create'))

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
                <th scope="col" class="border-0">Titulo</th>
                <th scope="col" class="border-0">Fecha Creación</th>
                <th scope="col" class="border-0"></th>
              </tr>
            </thead>
            <tbody>

                @foreach ($promotions as $promotion)
                <tr>
                    <td>{{ $promotion->id }}</td>
                    <td>{{ $promotion->title }}</td>
                    <td>{{ $promotion->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ url('owners/'. $owner->slug . '/promotions-delete/' . $promotion->id) }}" title="Borrar"><i class="fa fa-trash"></i></a>
                        <a href="{{ url('owners/'. $owner->slug . '/promotions/' . $promotion->id. '/edit') }}" title="Editar"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
          </table>
          {{ $promotions->links() }}
        </div>
      </div>
    </div>
</div>

@endsection
