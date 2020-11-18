@extends('layouts.admin')

@section('title', 'Categorías')
@section('route_create', url('owners/'. $owner->slug .'/categories/create'))

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
                <th scope="col" class="border-0">Unidad</th>
                <th scope="col" class="border-0">Medidas</th>
                <th scope="col" class="border-0"></th>
              </tr>
            </thead>
            <tbody>

                @foreach ($categories as $category)

                @php
                    $measures = json_decode($category->measure);
                @endphp

                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->unit ? $category->unit->name : '' }}</td>
                    <td>
                        @for($i=0;$i<count($measures);$i++)
                            {{ $measures[$i] }} <br>
                        @endfor
                    </td>
                    <td>
                        <a href="{{ url('owners/'. $owner->slug . '/categories-delete/' . $category->id) }}" title="Borrar"><i class="fa fa-trash"></i></a>
                        <a href="{{ url('owners/'. $owner->slug . '/categories/' . $category->id. '/edit') }}" title="Editar"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
          </table>
          {{ $categories->links() }}
        </div>
      </div>
    </div>
</div>

@endsection
