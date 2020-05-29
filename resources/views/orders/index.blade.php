@extends('layouts.admin')

@section('title', 'Pedidos')
@section('display_create', 'display:none;')

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
                <th scope="col" class="border-0">Cliente</th>
                <th scope="col" class="border-0">Estatus</th>
                <th scope="col" class="border-0">Total</th>
                <th scope="col" class="border-0"></th>
              </tr>
            </thead>
            <tbody>

                @foreach ($orders as $order)

                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->client->fullname }}</td>
                    <td>{{ $order->status->name }}</td>
                    <td>{{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        <a href="{{ url('owners/'. $owner->slug . '/orders/' . $order->id. '/edit') }}" title="Editar"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
          </table>
          {{ $orders->links() }}
        </div>
      </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/modal.js') }}"></script>
@endsection
