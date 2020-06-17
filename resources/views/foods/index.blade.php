@extends('layouts.admin')

@section('title', 'Comidas')
@section('route_create', url('owners/'. $owner->slug .'/foods/create'))

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
                <th scope="col" class="border-0">Tipo de Comida</th>
                <th scope="col" class="border-0">Nombre</th>
                <th scope="col" class="border-0">Precio</th>
                <th scope="col" class="border-0"></th>
              </tr>
            </thead>
            <tbody>

                @foreach ($foods as $food)

                <tr>
                    <td>{{ $food->id }}</td>
                    <td>{{ $food->category->name }}</td>
                    <td>{{ $food->name }}</td>
                    <td>{{ $food->price }}</td>
                    <td>
                        <a href="{{ url('owners/'. $owner->slug . '/foods-delete/' . $food->id) }}" title="Borrar"><i class="fa fa-trash"></i></a>
                        <a href="{{ url('owners/'. $owner->slug . '/foods/' . $food->id. '/edit') }}" title="Editar"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
          </table>
          {{ $foods->links() }}
        </div>
      </div>
    </div>
</div>

@endsection
