@extends('layouts.admin')

@section('title', 'Productos')
@section('route_create', url('owners/'. $owner->slug .'/items/create'))

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
                <th scope="col" class="border-0">Categoría</th>
                <th scope="col" class="border-0">Precios</th>
                <th scope="col" class="border-0"></th>
              </tr>
            </thead>
            <tbody>

                @foreach ($items as $item)

                @php
                    $prices = json_decode($item->price,true);
                @endphp

                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>
                        @if($prices)
                        @for($i=0;$i<count($prices);$i++)
                        {{ $prices[$i]['quantity'] . ' = ' . number_format($prices[$i]['price']) }} $<br>
                        @endfor
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('owners/'. $owner->slug . '/items-delete/' . $item->id) }}" title="Borrar"><i class="fa fa-trash"></i></a>
                        <a href="{{ url('owners/'. $owner->slug . '/items/' . $item->id. '/edit') }}" title="Editar"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
          </table>
          {{ $items->links() }}
        </div>
      </div>
    </div>
</div>

@endsection
