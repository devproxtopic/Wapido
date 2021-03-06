<!DOCTYPE html>
<html lang="sp">

	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" >
        <link rel="shortcut icon" type="image/ico" href="{{ asset('/favicon.ico') }}"/>
		<title>{{ env('APP_NAME') }}</title>

		<!-- Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
		<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link href="{{ asset('css/reset.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/themes.css') }}" rel="stylesheet">
		<link href="{{ asset('css/superslides.css') }}" rel="stylesheet">
		<link href="{{ asset('css/jquery.timepicker.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css"  />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <script src="{{ asset("js/jquery-1.11.3.min.js") }}"></script>
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
    </head>

	<body class="{{ $owner->theme ? $owner->theme : '' }}">
        <input type="hidden" name="message" id="message"
            @if(session("message")) value="{{ session("message") }}" @endif>
        <input type="hidden" id="url_base" value="{{ url('') }}">
			<header>
                <center>
                    <div style="max-width: 1000px;">
                        <img src="{{ isset($owner) ? asset($owner->logo) : '' }}" width="25%" class="logo-owner">
                        <br>
                        <a style="width:180px;" href="{{ isset($categories[0]) ? '#'.$categories[0]->name : '#' }}" class="calc">¡Vamos!</a>
                    </div>
                </center>

				{{-- <h1>{{ env('APP_NAME') }}</h1>
				<p class="intro">{{ env('APP_DESCRIPTION') }}</p> --}}
            </header>
            @php
                $sliders = isset($owner) ? json_decode($owner->sliders) : array();

                if(! $sliders){
                    $sliders = array();
                }
            @endphp
		<div id="slides">
			<div class="slides-container">
                @foreach($sliders as $slider)
                <img src="{{ asset($slider) }}" alt="">
                @endforeach
			</div>

			<nav class="slides-navigation">
				<a href="#" class="next"><i class="fa fa-angle-right"></i></a>
				<a href="#" class="prev"><i class="fa fa-angle-left"></i></a>
			</nav>
		</div>
        <div id="fixed-bg"></div>

    <form action="{{ route('orders.store', $owner->slug) }}" method="POST">
        @csrf
        <input type="hidden" id="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="slug" value="{{ $owner->slug }}">

        <input type="hidden" name="number_table" value="{{ $number_table }}">
        @if(count($promotions) > 0)
        <section>
			<article>
				<div class="article-item">
					<h2>Promociones</h2>
				</div>
                <div class="slideshow-container-promotions">
                    @foreach($promotions as $promotion)
                    <div class="mySlides-promotions fade-promotions">
                        <center>
                            <img width="100%" src="{{ asset('storage/' . $promotion->picture) }}" alt="">
                        </center>
                    </div>
                    @endforeach
                <!-- Navigation arrows -->
                <a class="prev-promotions" onclick="plusSlidesPromotions(-1)">&#10094;</a>
                <a class="next-promotions" onclick="plusSlidesPromotions(1)">&#10095;</a>

                </div>

                <!-- The dots/circles -->
                <div style="text-align:center">
                    @foreach ($promotions as $promotion)
                        <span class="dot-promotions" onclick="currentSlidePromotions({{$promotion->id}})"></span>
                    @endforeach
                </div>
			</article>
        </section>
        @endif

        @foreach($categories as $category)
        <section id="{{ $category->name }}">
			<article>
				<div class="article-item">
					<div class="circle-item {{ $owner->slug == 'jose-cuervo-1800' ? "white--color" : '' }}"><img src="{{ asset('storage/' . $category->img) }}" alt="{{ $category->name }}"></div>
                    <h2 @if($owner->slug == 'coca-cola-femsa') style="color:#000" @endif>{{ $category->name }}</h2>
				</div>
				<div class="pre-info">
					{{-- <span><i class="fa fa-star"></i></span> --}}
					{{-- <p>{{ $category->description }}</p> --}}
				</div>
				<ul class="item-list">
					<li class="labels-containers">
                        @foreach ($category->measures($category->id) as $measure)
                            <label for="">{{ $measure . ' ' . (($category->unit) ? $category->unit->symbol : '') }}</label>
                        @endforeach
					</li>
                    @foreach($category->items as $item)
                    <li class="list--icecream list-{{ $category->id }}">
                        <img class="circle-item-light" width="15%" src="{{ asset('storage/' . $item->img) }}">
                        <h3>{{ $item->name }}</h3>
                        @php
                            $prices = json_decode($item->price,true);
                        @endphp
                        @if($prices)
                        @for($i=0;$i<count($prices);$i++)
                        <div class="number-input circles-{{ $category->id }}">
                            <button type="button" onclick="stepDownNumbers('{{ $category->id }}-{{ $item->id }}-{{ $prices[$i]['quantity'] }}', {{ $category->id }});" ></button>
                        {{-- <button type="button" onclick="this.parentNode.querySelector('#quantity-{{ $category->id }}-{{ $item->id }}-{{ $prices[$i]['quantity'] }}').stepDown();" ></button> --}}
                        <input @if($owner->slug == 'jose-cuervo-1800' || $owner->slug == 'coca-cola-femsa') style="color: #000;" @endif
                            maxlength="2" data-price="{{ $prices[$i]['price'] }}" min="0" type="number" data-item="{{ $item->id }}"
                            placeholder="0" class="icecream-flav" data-quantity="{{ $prices[$i]['quantity'] }}"
                            id="quantity-{{ $category->id }}-{{ $item->id }}-{{ $prices[$i]['quantity'] }}"
                            name="quantity[{{ $item->id }}-{{ $prices[$i]['quantity'] }}-{{ $prices[$i]['price'] }}]">
                        {{-- <button type="button" onclick="this.parentNode.querySelector('#quantity-{{ $category->id }}-{{ $item->id }}-{{ $prices[$i]['quantity'] }}').stepUp();" class="plus"></button> --}}
                            <button type="button" onclick="stepUpNumbers('{{ $category->id }}-{{ $item->id }}-{{ $prices[$i]['quantity'] }}', {{ $category->id }});" class="plus"></button>
                        </div>
                        {{-- <div class="circle-input circles-{{ $category->id }}">

                        {{-- <span class='number-wrapper'>
                            <input @if($owner->slug == 'jose-cuervo-1800' || $owner->slug == 'coca-cola-femsa') style="color: #000;" @endif
                            maxlength="2" data-price="{{ $prices[$i]['price'] }}" min="0" type="number" data-item="{{ $item->id }}"
                            value="0" class="icecream-flav" data-quantity="{{ $prices[$i]['quantity'] }}"
                            id="quantity-{{ $category->id }}-{{ $item->id }}-{{ $prices[$i]['quantity'] }}"
                            name="quantity[{{ $item->id }}-{{ $prices[$i]['quantity'] }}-{{ $prices[$i]['price'] }}]">
                            {{-- <div class="buttons-control-input">
                                <div class="inc button">+</div>
                                <div class="dec button">-</div>
                            </div> --}}
                            {{-- <div id="inc-button" class="spinner-button">+</div>
                            <div id="dec-button" class="spinner-button">-</div> --}}
                        {{-- </span>
                        </div> --}}
                        @endfor
                        @endif
					</li>
                    @endforeach
					<li class="no--padd">
                        <button type="button" onclick="subtotalCalculation({{ $category->id }})" class="calc">Calcular</button>
					</li>
					<li>
						{{-- <div class="box-detail icecream--box">
							<p><i class="fa fa-star"></i><br>
							<span class="circle icecream star-{{ $category->id }}">0</span>
							</p>
						</div><!--
						--><div class="box-detail icecream--box">
							<p>{{ $category->unit->name }}<br>
							<span class="circle total-ltr-ice quantity-{{ $category->id }}">0</span>
							</p>
						</div><!-- --}}
						<div class="box-detail icecream--box ">
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

        @foreach($owner->foods->groupBy('category_food_id') as $arrayFood)
        <section id="{{ $arrayFood[0]->category->name }}">
			<article>
				<div class="article-item">
					<div class="circle-item"><img src="{{ asset('storage/' .  $arrayFood[0]->category->picture) }}" alt="{{ $arrayFood[0]->category->name }}"></div>
                    <h2>{{ $arrayFood[0]->category->name }}</h2>
				</div>
				<div class="pre-info">
					<span><i class="fa fa-star"></i></span>
					<p>{{ $arrayFood[0]->category->description }}</p>
				</div>
				<ul class="item-list">
					<li class="labels-containers">
                        <label for="">Cantidad</label>
					</li>
                    @foreach($arrayFood as $item)
                    <li class="list--icecream list-food-{{ $arrayFood[0]->category->id }}">
                        <img class="circle-item-light" width="15%" src="{{ asset('storage/' . $item->picture) }}">
                        <h3>{{ $item->name }}</h3>
                        <div class="number-input circles-food-{{ $arrayFood[0]->category->id }}">
                        <button type="button" onclick="this.parentNode.querySelector('#quantity-food-{{ $arrayFood[0]->category->id }}-{{ $item->id }}-1').stepDown();subtotalCalculationFood({{ $arrayFood[0]->category->id }});" ></button>
                        <input maxlength="2" data-price="{{ $item->price }}" type="number" data-item="{{ $item->id }}"
                            placeholder="0" class="icecream-flav" data-quantity="1"
                            id="quantity-food-{{ $arrayFood[0]->category->id }}-{{ $item->id }}-1"
                            name="quantity_food[{{ $item->id }}-{{ $item->price }}]">
                        <button type="button" onclick="this.parentNode.querySelector('#quantity-food-{{ $arrayFood[0]->category->id }}-{{ $item->id }}-1').stepUp();subtotalCalculationFood({{ $arrayFood[0]->category->id }});" class="plus"></button>
                        </div>
                        {{-- <div class="circle-input circles-food-{{ $arrayFood[0]->category->id }}">
                            <input
                            maxlength="2" data-price="{{ $item->price }}" type="number" data-item="{{ $item->id }}"
                            placeholder="0" class="icecream-flav" data-quantity="1"
                            id="quantity-food-{{ $arrayFood[0]->category->id }}-{{ $item->id }}-1"
                            name="quantity_food[{{ $item->id }}-{{ $item->price }}]">
                        </div> --}}
					</li>
                    @endforeach
					<li class="no--padd">
                        <button type="button" onclick="subtotalCalculationFood({{ $arrayFood[0]->category->id }})" class="calc">Calcular</button>
					</li>
					<li>
						<div class="box-detail icecream--box ">
                            <p>Costo<br>
                            <input type="hidden" name="subtotal-food-{{ $arrayFood[0]->category->id }}" id="subtotal-food-{{ $arrayFood[0]->category->id }}" class="subtotal">
							<span class="price">$</span> <span class="price total-price-icecream amount-food-{{ $arrayFood[0]->category->id }}">0</span>
							</p>
						</div>
					</li>
				</ul>
			</article>
        </section>
        @endforeach

		<!-- FINAL -->
		<section>
			<h2>Pedido Final</h2><br>
			<ul class="first-list final">
                @foreach($categories as $category)
				<li>
                    <img width="15%" src="{{ asset('storage/' . $category->img) }}">
                    {{ $category->name }}
					<div class="price">$ <span class="total-price-beer amount-{{ $category->id }}">0</div>
					<div class="numbers total-ltr quantity-{{ $category->id }}" id="total-ltr">0</div>
                </li>
                @endforeach
                @foreach($owner->foods->groupBy('category_food_id') as $category_food)
				<li>
                    <img width="15%" src="{{ asset('storage/' . $category_food[0]->category->picture) }}">
                    {{ $category_food[0]->category->name }}
					<div class="price">$ <span class="total-price-beer amount-food-{{ $category_food[0]->category->id }}">0</div>
					<div class="numbers total-ltr quantity-{{ $category_food[0]->category->id }}" id="total-ltr">0</div>
                </li>
                @endforeach
            </ul>
            <input type="hidden" name="total_amount" id="total_amount">
			<h4 @if($owner->slug == 'coca-cola-femsa') style="color:#000" @endif>TOTAL: $ <span class="total-price"></span> <br></h4>

			<!-- <a href="form.html" class="confirm-button">CONFIRMAR</a> -->
		</section>

		<!-- Form -->
		<section class="form">
            <h2>Complete el formulario:</h2>

            @if(! $number_table)
                <fieldset>
                    <div class="custom-control custom-radio mb-1">
                        <input type="radio" id="delivery_1" name="apply_delivery" class="custom-control-input" checked value="1">
                        <label class="custom-control-label" for="delivery_1">Envío a Domicilio</label>
                    </div>
                    <div class="custom-control custom-radio mb-1">
                        <input type="radio" id="delivery_2" name="apply_delivery" class="custom-control-input" value="0">
                        <label class="custom-control-label" for="delivery_2">Recoger en Tienda</label>
                    </div>
                </fieldset>
            @endif

                <label for="">Código Postal *</label>
                <input type="text" id="zipcode" name="zipcode" value="{{ old('zipcode') }}" required placeholder="Código Postal">
                <br>
                <label for="">Sucursal *</label>
                <select class="form-control" name="branch_id" id="branch_id" required>
                    {{-- SE LLENA CON AJAX--}}
                </select>
                <br>
				<label for="">Mail *</label>
				<input type="text" id="email" name="email" value="{{ old('email') }}" required placeholder="Email">
				<label for="">Nombre Completo *</label>
                <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}" required placeholder="Nombre">
				<label for="">Celular *</label>
				<input type="text" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="Celular">

            @if(! $number_table)
				<label for="">Dirección *</label>
                <textarea name="address" id="address" required cols="" rows="6">{{ old('address') }}</textarea>

                <fieldset>
                    <div class="custom-control custom-radio mb-1">
                        <input type="radio" id="payment_1" name="payment" class="custom-control-input" checked value="1">
                        <label class="custom-control-label" for="payment_1">Pagar en Efectivo</label>
                    </div>
                    <div class="custom-control custom-radio mb-1">
                        <input type="radio" id="payment_2" name="payment" class="custom-control-input" value="0">
                        <label class="custom-control-label" for="payment_2">Pagar con Tarjeta</label>
                    </div>
                </fieldset>
            @endif

                <label>Los campos marcados con * son obligatorios.</label>
                <br>
                <button @if($owner->slug == 'coca-cola-femsa') style="background-color:#000" @endif type="submit" id="submit_button">REALIZAR PEDIDO</button>
				<div id="result" class=""></div>
        </section>
    </form>


		<footer>
        <center><img src="{{ asset('img/logo.png') }}" width="15%"></center> <br>
			<h5>{{-- Blvd. Campestre 1907 <br>
			Col. Valle del Campestre, León, Gto.<br>
			Tel.: 477 717 64 32 <br> --}}
			info@wapido.com</h5>
			<!--<h6>Comparti tu experiencia en: <a href="http://www.tripadvisor.es/Restaurant_Review-g294323-d1804509-Reviews-Facal-Montevideo_Montevideo_Department.html" target="_blank"><img src="img/trip-advisor.svg" alt=""></a> <a href="https://www.facebook.com/BarFacal" target="_blank"><i class="fa fa-facebook-official"></i></a></h6>-->
        </footer>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog modal-success">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1>Su pedido ha sido realizado con éxito</h1>
                    </div>
                    <div class="modal-body">
                        Gracias por preferirnos.
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog modal-notify modal-danger">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1>Su pedido no puede realizarse</h1>
                    </div>
                    <div class="modal-body">
                        <p>Debe seleccionar un producto para realizar un pedido.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="floatMenu">
            @isset($owner->reservations_enabled)
            <ul class="menu1">
                <li><a href="{{ url('/' . $owner->slug . '/reservations/create') }}">RESERVACIONES</a></li>
            </ul>
            @endisset
            @isset($owner->main_digital_enabled)
            <ul class="menu2">
                <li><a id="mainDigital" href="{{ url('/' . $owner->slug . '/main_digital') }}">MENU DIGITAL</a></li>
            </ul>
            @endisset
            {{--
            <ul class="menu3">
                <li><a href="#" onclick="return false;"> Home </a></li>
            </ul> --}}
        </div>

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
                    $('#errorModal').modal();
                    //toastr.error("{{ session('message') }}");
                    break;
                default:
                @if(! $number_table)
                    window.open("https://api.whatsapp.com/send?phone={{ $owner->phone }}&text=Se ha creado un nuevo pedido, puede verlo en la siguiente url: {{url($owner->slug . '/orders-show/' . session('message'))}}", '_blank');
                @endif
                    $('#myModal').modal();
                    break;
            }
    </script>
    @endif

        <script>
        var name = "#floatMenu";
        var menuYloc = null;
        $(name).css('display', 'none');

        $(document).ready(function(){
            menuYloc = parseInt($(name).css("top").substring(0,$(name).css("top").indexOf("px")));
            $(window).scroll(function () {
                var offset = menuYloc+$(document).scrollTop()+"px";
                if(menuYloc+$(document).scrollTop() > 413){
                    $(name).animate({top:offset},{duration:500,queue:false});
                    $(name).css('display', 'block');
                } else {
                    $(name).css('display', 'none');
                }
            });

            var client = @json($client);
            var order = @json($order);

            if(client && order){
                orderExists(order, client);
            }
        });
        </script>

        <script>
            function stepDownNumbers(id, category_id){
                var element = 'quantity-'+id;
                document.getElementById(element).stepDown();
                // console.log(element);
                subtotalCalculation(category_id);
            }

            function stepUpNumbers(id, category_id){
                var element = 'quantity-'+id;
                // console.log(element);
                document.getElementById(element).stepUp();
                subtotalCalculation(category_id);
            }
        </script>
	</body>
</html>
