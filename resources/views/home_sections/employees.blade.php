<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
        <div class="card card-small">
            <div class="card-header border-bottom">
                <h6 class="m-0">Notificaciones sin leer</h6>
            </div>
            <div class="card-body">
                <table class="table mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0"># Orden</th>
                            <th scope="col" class="border-0">Cliente</th>
                            <th scope="col" class="border-0"># Mesa</th>
                            <th scope="col" class="border-0">Marcar como leído</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Auth::user()->unreadNotifications as $notification)
                        @php
                            $order = App\Models\Order::find($notification->data['order_id']);
                        @endphp
                        <tr>
                            <td><a href="{{ url('/'.$order->owner->slug.'/orders-show/'.$order->id) }}">{{ $order->id }}</a></td>
                            <td>{{ $order->client->fullname }}</td>
                            <td>{{ $order->number_table }}</td>
                            <td>
                                {{ $notification->markAsRead() }}
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
 </div>

 <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
        <div class="card card-small">
            <div class="card-header border-bottom">
                <h6 class="m-0">Ordenes</h6>
            </div>
            <div class="card-body">
                <table class="table mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0"># Orden</th>
                            <th scope="col" class="border-0">Cliente</th>
                            <th scope="col" class="border-0"># Mesa</th>
                            <th scope="col" class="border-0">Fecha de Lectura</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Auth::user()->notifications  as $notification)
                        @php
                            $order = App\Models\Order::find($notification->data['order_id']);
                        @endphp
                        <tr>
                            <td><a href="{{ url('/'.$order->owner->slug.'/orders-show/'.$order->id) }}">{{ $order->id }}</a></td>
                            <td>{{ $order->client->fullname }}</td>
                            <td>{{ $order->number_table }}</td>
                            <td>
                                {{ $notification->read_at }}
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
 </div>
