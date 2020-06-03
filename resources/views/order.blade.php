<!DOCTYPE html>
<html lang="sp">

	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" >
        <link rel="shortcut icon" type="image/ico" href="{{ asset('/favicon.ico') }}"/>
		<title>{{ env('APP_NAME') }}</title>

		<!-- Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
		<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link href="{{ asset('css/reset.css') }}" rel="stylesheet">
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
		<link href="{{ asset('css/superslides.css') }}" rel="stylesheet">
		<link href="{{ asset('css/jquery.timepicker.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css"  />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="{{ asset('js/jquery.timepicker.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/datepair.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/jquery.datepair.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/global.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/index.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/jquery.animate-enhanced.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/jquery.superslides.js') }}" type="text/javascript" charset="utf-8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<style>
            table {

              border-collapse: collapse;
              width: 70%;


            }
            th, td {
                border: 1px solid black;
                 text-align:center;
                 padding: 8px;
                 color: black;
                 font-size: 12px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }

            .button {
              background-color: blue; /* Green */
              border: none;
              color: white;
              padding: 10px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 12px;
              margin: 4px 2px;
              cursor: pointer;
            }


            .button1 {border-radius: 8px;}


           // h1 {
             // margin: 0;
             //display: inline;
        //    }
            .button2 {
                float: right;
                margin-right: 40px;
            }
        </style>
    </head>
    <body>
        <div id="fixed-bg"></div>
        <br>
        <div >
             <center>
				<div><img src="{{ asset($owner->logo) }}" width="30%"></div>
				</center>


            <h1>Pedido de {{ $client->fullname }}</h1>
            <br>

            <div class="col-sm-6 offset-sm-2">
                <h3>Información del pedido</h3>
                <p style="font-size: 15px; color: #000;">Orden #: <strong>{{ $orderDB->id }}</strong><br>
                <strong>{{ $orderDB->created_at->format('d/m/Y H:m:s') }}</strong><br>
                Email: <strong>{{ $client->email }}</strong><br>
                Dirección: <strong>{{ $client->address }}</strong> <br>
                Celular: <strong>{{ $client->phone }}</strong> <br>
                Estatus: <strong>{{ $orderDB->status->name }}</strong> <br>
                Modalidad: <strong>@if($orderDB->apply_delivery == 1)Envío a Domicilio
                    @else Recoger en Tienda @endif</strong><br>
                Tipo de Pago: <strong>@if($orderDB->payment == 1)Efectivo
                    @else Tarjeta @endif</strong>
            </p>

            </div>

        </div>

        <br>
        <br>

        @foreach ($order as $category_id => $item)
            <center>
                @php
                    $category = \App\Models\Category::find($category_id);
                @endphp
                <h1>{{ $category->name }}</h1>
                <br>
                <table>
                    <tr>
                        <th>Producto</th>
                        @foreach (json_decode($category->measure) as $measure)
                        <th>{{ $measure . ' ' . $category->unit->name }}</th>
                        @endforeach
                    </tr>
                    @foreach ($item as $productChoose)
                    <tr>
                        <td>{{ \App\Models\Item::find($productChoose['item_id'])->name }}</td>
                        @foreach (json_decode($category->measure) as $measure)
                        <th>
                            @if($productChoose['measure'] == $measure)
                            {{ $productChoose['quantity'] }}
                            @else
                            0
                            @endif
                        </th>
                        @endforeach
                    </tr>
                    @endforeach
                </table>

            </center>
        @endforeach

        <center>
            <h1>Total</h1><br>
            <table>
                <tr>
                    <th>Conceptos</th>
                    <th>Monto</th>
                </tr>
                @foreach ($order as $category_id => $item)
                @php
                    $itemSum = 0;
                @endphp
                <tr>
                    <td>{{ \App\Models\Category::find($category_id)->name }}</td>
                    @foreach ($item as $itemChoose)
                    @php
                        $itemSum += $itemChoose['price'] * $itemChoose['quantity'];
                    @endphp
                    @endforeach
                    <td>{{ $itemSum }}</td>
                </tr>
                @endforeach
                <tr>
                    <td>Total</td>
                    <td>{{ $orderDB->total_amount }}</td>
                </tr>
            </table>

        </center>
       {{-- <section class="form">
        <button onclick="sendConfirmation()" id="submit_confirmation">Confirmar Pedido</button>
        </section> --}}

    <br>
    <br>


    </body>
</html>
