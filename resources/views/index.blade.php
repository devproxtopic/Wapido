<!DOCTYPE html>
<html lang="sp">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" >
		<title>{{ env('APP_NAME') }}</title>

		<!-- Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
		<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

		<!-- Styles -->
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

	</head>

	<body>
        <input type="hidden" name="message" id="message"
            @if(session("message")) value="{{ session("message") }}" @endif>
        <input type="hidden" id="url_base" value="{{ url('') }}">
		<div id="slides">
			<header>
			    <center>
				<div><img src="{{ asset('img/logo.png') }}" height="62" width="300"></div></center>
				<h1>{{ env('APP_NAME') }}</h1>
				<p class="intro">{{ env('APP_DESCRIPTION') }}</p>
			</header>
			<div class="slides-container">
                <img src="{{ asset('img/slider_1.jpg') }}" alt="">
                <img src="{{ asset('img/slider_2.jpg') }}" alt="">
                <img src="{{ asset('img/slider_3.jpg') }}" alt="">
			</div>

			<nav class="slides-navigation">
				<a href="#" class="next"><i class="fa fa-angle-right"></i></a>
				<a href="#" class="prev"><i class="fa fa-angle-left"></i></a>
			</nav>
		</div>
        <div id="fixed-bg"></div>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        @foreach($categories as $category)
        <section>
			<article>
				<div class="article-item">
					<div class="circle-item"><img src="{{ asset('storage/' . $category->img) }}" alt="{{ $category->name }}"></div>
                    <h2>{{ $category->name }}</h2>
				</div>
				<div class="pre-info">
					<span><i class="fa fa-star"></i></span>
					<p>{{ $category->description }}</p>
				</div>
				<ul class="item-list">
					<li class="labels-containers">
                        @foreach ($category->measures($category->id) as $measure)
                            <label for="">{{ $measure . ' ' . $category->unit->symbol }}</label>
                        @endforeach
					</li>
                    @foreach($category->items as $item)
					<li class="list--icecream list-{{ $category->id }}">
                        <h3>{{ $item->name }}</h3>
                        @php
                            $prices = json_decode($item->price,true);
                        @endphp
                        @for($i=0;$i<count($prices);$i++)
                        <div class="circle-input circles-{{ $category->id }}">
                            <input @isset($order) disabled @endisset
                            maxlength="2" data-price="{{ $prices[$i]['price'] }}" type="text" data-item="{{ $item->id }}"
                            placeholder="0" class="icecream-flav" data-quantity="{{ $prices[$i]['quantity'] }}"
                            id="quantity-{{ $category->id }}-{{ $item->id }}-{{ $prices[$i]['quantity'] }}"
                            name="quantity[{{ $item->id }}-{{ $prices[$i]['quantity'] }}-{{ $prices[$i]['price'] }}]">
                        </div>
                        @endfor
					</li>
                    @endforeach
					<li class="no--padd">
                        <button @isset($order) style="display: none;" @endisset
                        type="button" onclick="subtotalCalculation({{ $category->id }})" class="calc">Calcular</button>
					</li>
					<li>
						<div class="box-detail icecream--box">
							<p><i class="fa fa-star"></i><br>
							<span class="circle icecream star-{{ $category->id }}">0</span>
							</p>
						</div><!--
						--><div class="box-detail icecream--box">
							<p>{{ $category->unit->name }}<br>
							<span class="circle total-ltr-ice quantity-{{ $category->id }}">0</span>
							</p>
						</div><!--
						--><div class="box-detail icecream--box ">
                            <p>Costo<br>
                            <input type="hidden" name="subtotal-{{ $category->id }}" id="subtotal-{{ $category->id }}" class="subtotal">
							<span class="price">$</span> <span class="price total-price-icecream amount-{{ $category->id }}">0</span>
							</p>
						</div>
					</li>
				</ul>
			</article>
        </section>
        @endforeach

		<!-- FINAL -->
		<section>
			<h2>Pedido Final<br>
			<ul class="first-list final">
                @foreach($categories as $category)
				<li>
					<img src="{{ asset('storage/' . $category->img) }}">{{ $category->name }}<span>{{ $category->unit->name }}</span>
					<div class="price">$ <span class="total-price-beer amount-{{ $category->id }}">0</div>
					<div class="numbers total-ltr quantity-{{ $category->id }}" id="total-ltr">0</div>
                </li>
                @endforeach
            </ul>
            <input type="hidden" name="total_amount" id="total_amount">
			<h4>TOTAL: $ <span class="total-price"></span> <br></h4>

			<!-- <a href="form.html" class="confirm-button">CONFIRMAR</a> -->
		</section>

		<!-- Form -->
		<section class="form">
			<h2>Complete el formulario:</h2>
				<label for="">Mail *</label>
				<input type="text" id="email" name="email" value="{{ old('email') }}" required placeholder="Email">
				<label for="">Nombre Completo *</label>
                <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}" required placeholder="Nombre">
				<label for="">Celular *</label>
				<input type="text" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="Celular">
				<label for="">Dirección *</label>
				<textarea name="address" id="address" required cols="" rows="6">{{ old('address') }}</textarea>
				<span>Los campos marcados con * son obligatorios.</span>
                <button @isset($order) style="display: none;" @endisset
                 type="submit" id="submit_button">REALIZAR PEDIDO</button>
				<div id="result" class=""></div>
		</section>
	</form>

		<footer>
        <img src="{{ asset('img/logo.png') }}" height="41" width="200">
			<h5>{{-- Blvd. Campestre 1907 <br>
			Col. Valle del Campestre, León, Gto.<br>
			Tel.: 477 717 64 32 <br> --}}
			info@wapido.com</h5>
			<!--<h6>Comparti tu experiencia en: <a href="http://www.tripadvisor.es/Restaurant_Review-g294323-d1804509-Reviews-Facal-Montevideo_Montevideo_Department.html" target="_blank"><img src="img/trip-advisor.svg" alt=""></a> <a href="https://www.facebook.com/BarFacal" target="_blank"><i class="fa fa-facebook-official"></i></a></h6>-->
        </footer>

        @if(session("message"))
    <script>
            var type = "{{ session('alert-type') }}";
            switch(type){
                case 'info':
                    toastr.info("{{ session('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ session('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ session('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ session('message') }}");
                    break;
                default:
                    toastr.info("{{ session('message') }}");
                    break;
            }
    </script>
    @endif

        <script>
            $(document).ready(function() {

                var client = @json($client);
                var order = @json($order);

                if(client && order){
                    orderExists(order, client);
                }
            });
        </script>

	</body>
</html>
