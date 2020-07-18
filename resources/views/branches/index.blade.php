@extends('layouts.admin')

@section('title', 'Sucursal')
@section('route_create', url('owners/'. $owner->slug .'/branches/create'))

@section('content')

<div class="row">
    <div class="col">
      <div class="card card-small mb-4">
        <div class="card-header border-bottom">
          <h6 class="m-0">Listado</h6>
        </div>
        <div style="overflow-x:auto;" class="card-body p-0 pb-3 text-center">
          <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
            <thead class="bg-light">
              <tr>
                <th scope="col" class="border-0">#</th>
                <th scope="col" class="border-0">Nombre</th>
                <th scope="col" class="border-0">Dirección</th>
                <th scope="col" class="border-0">Teléfono</th>
                <th scope="col" class="border-0">Email</th>
                <th scope="col" class="border-0"></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($branches as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->address }}</td>
                    <td>{{ $category->phone }}</td>
                    <td>{{ $category->email }}</td>
                    <td>
                        <a href="{{ url('owners/'. $owner->slug . '/branches-delete/' . $category->id) }}" title="Borrar"><i class="fa fa-trash"></i></a>
                        <a href="{{ url('owners/'. $owner->slug . '/branches/' . $category->id. '/edit') }}" title="Editar"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
          {{ $branches->links() }}
        </div>
      </div>
    </div>
</div>

@endsection
