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

	<body>
        <input type="hidden" name="message" id="message"
            @if(session("message")) value="{{ session("message") }}" @endif>
        <input type="hidden" id="url_base" value="{{ url('') }}">
			<header>
			    <center>
                    <div style="max-width: 1000px;" >
                        <img src="{{ asset('img/wapido_logo2.png') }}" width="25%" class="logo-owner">
                        <br>
                        <a style="width:180px;" href="#" class="calc">Lista de Restaurantes</a>
                    </div>
                </center>

				{{-- <h1>{{ env('APP_NAME') }}</h1>
				<p class="intro">{{ env('APP_DESCRIPTION') }}</p> --}}
            </header>

        <div id="slides">
			<div class="slides-container">
                <img src="{{ asset('img/4.jpg') }}" alt="">
                <img src="{{ asset('img/5.jpg') }}" alt="">
                <img src="{{ asset('img/6.jpg') }}" alt="">
			</div>

			<nav class="slides-navigation">
				<a href="#" class="next"><i class="fa fa-angle-right"></i></a>
				<a href="#" class="prev"><i class="fa fa-angle-left"></i></a>
			</nav>
		</div>
        <div id="fixed-bg"></div>

    <form action="{{ url('/restaurants') }}" method="POST">
        @csrf

        <div class="filters_restaurants">
            <input type="hidden" name="reqCity" id="reqCity" value="{{ $city_id }}">
            <input type="hidden" name="reqState" id="reqState" value="{{ $state_id }}">
            <input type="hidden" name="reqLocation" id="reqLocation" value="{{ $location_id }}">

            <select class="form-control select_filters_restaurants" name="country_id" id="country_id">
                <option value="">Seleccione un País</option>
                @foreach ($countries as $country)
                <option @if($country_id == $country->id) selected @endif value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
            <select disabled class="form-control select_filters_restaurants" name="state_id" id="state_id">
                <option value="">Seleccione un Estado</option>
                @if($country_id)
                @foreach (\App\Models\Country::find($country_id)->states as $state)
                <option @if($state_id == $state->id) selected @endif value="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
                @endif
                {{-- SE LLENA CON AJAX --}}
            </select>
        </div>

        <div class="filters_restaurants">
            <select disabled class="form-control select_filters_restaurants" name="city_id" id="city_id">
                <option value="">Seleccione una Ciudad</option>
                @if($city_id)
                @foreach (\App\Models\City::find($city_id)->state->cities as $city)
                <option @if($city_id == $city->id) selected @endif value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
                @endif
                {{-- SE LLENA CON AJAX --}}
            </select>
            <select disabled class="form-control select_filters_restaurants" name="location_id" id="location_id">
                <option value="">Seleccione una Localidad</option>
                @if($location_id)
                @foreach (\App\Models\Location::find($location_id)->city->locations as $location)
                <option @if($location_id == $location->id) selected @endif value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
                @endif
                {{-- SE LLENA CON AJAX --}}
            </select>
        </div>

        <div class="filters_restaurants">
            <select class="form-control select_filters_restaurants" name="category_food_id" id="category_food_id">
                <option value="">Seleccione un Tipo de Comida</option>
                @foreach ($categories_food as $category_food)
                <option @if($category_food_id == $category_food->id) selected @endif value="{{ $category_food->id }}">{{ $category_food->name }}</option>
                @endforeach
            </select>
        </div>

        <section class="form">

            <button type="submit" id="submit_button">REALIZAR BUSQUEDA</button>
            <div id="result" class=""></div>
		</section>

        @foreach($restaurants as $restaurant)
        <section id="{{ $restaurant->name }}">
			<article>
				<div class="article-item">
					<div class="circle-item"><img src="{{ asset($restaurant->logo) }}" alt="{{ $restaurant->name }}"></div>
                    <h2>{{ $restaurant->name }}</h2>
				</div>
				<div class="pre-info">
					<span><i class="fa fa-star"></i></span>
					<p>{{ $restaurant->description }}</p>
				</div>
				<ul class="item-list">
                    <li class="labels-containers">
                        <label for=""></label>
					</li>
                    <li class="list--icecream">
                        <p>Ubicación:<br>
                        @isset($restaurant->location)
                        {{ $restaurant->location->name . '. ' .  $restaurant->location->city->name . '. ' .
                        $restaurant->location->city->state->name . '. ' . $restaurant->location->city->state->country->name}}
                        @endisset
                        </p>
                    </li>
                    <li class="list--icecream">
                        <p>Teléfono:<br>
                        {{ $restaurant->phone }}
                        </p>
                    </li>
					<li class="no--padd">
                        <a href="" class="calc">Ir al restaurante</a>
					</li>
					<li>
						<div class="box-detail icecream--box ">
                            <p>Tipos de Comida<br>
                            @php
                                $totalFoods = count($restaurant->foods->groupBy('category_food_id'));
                                $count = 1;
                            @endphp
                            @foreach ($restaurant->foods->groupBy('category_food_id') as $item)
                            <span class="price total-price-icecream amount-{{ $restaurant->id }}">
                                {{ $item[0]->category->name . ($totalFoods != $count ? ',' : '') }}
                            </span>
                            @php
                                $count++;
                            @endphp
                            @endforeach
							</p>
						</div>
					</li>
				</ul>
			</article>
        </section>
        @endforeach

	</form>
        <script src="{{ asset('js/ajax/locations.js') }}"></script>

		<footer>
        <center><img src="{{ asset('img/logo.png') }}" width="15%"></center> <br>
			<h5>{{-- Blvd. Campestre 1907 <br>
			Col. Valle del Campestre, León, Gto.<br>
			Tel.: 477 717 64 32 <br> --}}
			info@wapido.com</h5>
			<!--<h6>Comparti tu experiencia en: <a href="http://www.tripadvisor.es/Restaurant_Review-g294323-d1804509-Reviews-Facal-Montevideo_Montevideo_Department.html" target="_blank"><img src="img/trip-advisor.svg" alt=""></a> <a href="https://www.facebook.com/BarFacal" target="_blank"><i class="fa fa-facebook-official"></i></a></h6>-->
        </footer>

	</body>
</html>
