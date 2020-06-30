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
        <script type="text/javascript" src="{{ asset('js/restaurants.js') }}"></script>

        <script type="text/javascript" src="{{ asset('js/jsQR.js') }}"></script>
    </head>

	<body id="restaurants">
        <input type="hidden" name="message" id="message"
            @if(session("message")) value="{{ session("message") }}" @endif>
        <input type="hidden" id="url_base" value="{{ url('') }}">
        <div class="restaurant_header">
            <center>
				<div>
                    <img src="{{ asset('img/wapido_logo2.png') }}" width="30%">
                </div>
            </center>

    <form action="{{ url('/restaurants') }}" method="POST">
        @csrf

        <div class="filters_restaurants">
            <select class="select_filters_restaurants" name="country_id" id="country_id">
                <option value="">Seleccione un País</option>
                @foreach ($countries as $country)
                <option @if($country_id == $country->id) selected @endif value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
            <select disabled class="select_filters_restaurants" name="state_id" id="state_id">
                <option value="">Seleccione un Estado</option>
                @if($country_id)
                @foreach (\App\Models\Country::find($country_id)->states as $state)
                <option @if($state_id == $state->id) selected @endif value="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
                @endif
                {{-- SE LLENA CON AJAX --}}
            </select>

            <select disabled class="select_filters_restaurants" name="city_id" id="city_id">
                <option value="">Seleccione una Ciudad</option>
                @if($country_id && $state_id)
                @foreach (\App\Models\Country::find($country_id)->states->find($state_id)->cities as $city)
                <option @if($city_id == $city->id) selected @endif value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
                @endif
                {{-- SE LLENA CON AJAX --}}
            </select>
            <select disabled class="select_filters_restaurants" name="location_id" id="location_id">
                <option value="">Seleccione una Localidad</option>
                @if($country_id && $state_id && $city_id)
                @foreach (\App\Models\Country::find($country_id)->states->find($state_id)->cities->find($city_id)->locations as $location)
                <option @if($location_id == $location->id) selected @endif value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
                @endif
                {{-- SE LLENA CON AJAX --}}
            </select>

            <select class="select_filters_restaurants" name="category_food_id" id="category_food_id">
                <option value="">Seleccione un Tipo de Comida</option>
                @foreach ($categories_food as $category_food)
                <option @if($category_food_id == $category_food->id) selected @endif value="{{ $category_food->id }}">{{ $category_food->name }}</option>
                @endforeach
            </select>

            <div class="buttons_restaurants">
                <button type="submit" id="submit_button">REALIZAR BUSQUEDA</button>
                <a href="{{ url('/restaurants') }}" id="reset_button_restaurant">RESETEAR BUSQUEDA</a>
            </div>
        </div>

        @foreach($restaurants as $restaurant)
        <section id="{{ $restaurant->name }}">
			<article>
				<div class="article-item">
					<div class="circle-item white--color"><img src="{{ asset($restaurant->logo) }}"></div>
				</div>
				<div class="pre-info">
					<p>{{ $restaurant->description }}</p>
				</div>
				<ul class="item-list restaurants">
                    <h2>{{ $restaurant->name }}</h2>
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
                    @isset($restaurant->reservations_enabled)
                    <button onclick="window.open('{{ url('/' . $restaurant->slug . '/reservations/create') }}', 'reservations');" class="calc button_restaurant" type="button" id="reservation_button">RESERVACIONES</button>
                    @endisset
                    @isset($restaurant->main_digital_enabled)
                    <button id="main_digital_button" onclick="window.open('{{ url('/' . $restaurant->slug . '/choose-table') }}');" class="calc button_restaurant" type="button">MENU DIGITAL</button>
                    @endisset
                    @isset($restaurant->order_enabled)
                    <button onclick="window.open('{{ url('/' . $restaurant->slug) }}', 'orders');" class="calc button_restaurant" type="button" id="order_button">PEDIDOS</button>
                    @endisset
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
    {{-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog modal-notify modal-success">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Por favor indique su número de mesa</h1>
                </div>
                <div class="modal-body">
                    <a id="githubLink" href="https://github.com/cozmo/jsQR">View documentation on Github</a>
                    <p>Pure JavaScript QR code decoding library.</p>
                    <div id="loadingMessage">🎥 Unable to access video stream (please make sure you have a webcam enabled)</div>
                    <canvas id="canvas" hidden></canvas>
                    <div id="output" hidden>
                        <div id="outputMessage">No QR code detected.</div>
                        <div hidden><b>Data:</b> <span id="outputData"></span></div>
                    </div>
                    <span>Si el lector de QR no abre, por favor, seleccione un número de la lista de mesas.</span>

                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
                </div>
            </div>
        </div>
    </div> --}}
        <script src="{{ asset('js/ajax/locations.js') }}"></script>

		<footer>
        <center><img src="{{ asset('img/logo.png') }}" width="15%"></center> <br>
			<h5>{{-- Blvd. Campestre 1907 <br>
			Col. Valle del Campestre, León, Gto.<br>
			Tel.: 477 717 64 32 <br> --}}
			info@wapido.com</h5>
			<!--<h6>Comparti tu experiencia en: <a href="http://www.tripadvisor.es/Restaurant_Review-g294323-d1804509-Reviews-Facal-Montevideo_Montevideo_Department.html" target="_blank"><img src="img/trip-advisor.svg" alt=""></a> <a href="https://www.facebook.com/BarFacal" target="_blank"><i class="fa fa-facebook-official"></i></a></h6>-->
        </footer>

        {{-- <script>
            var video = document.createElement("video");
            var canvasElement = document.getElementById("canvas");
            var canvas = canvasElement.getContext("2d");
            var loadingMessage = document.getElementById("loadingMessage");
            var outputContainer = document.getElementById("output");
            var outputMessage = document.getElementById("outputMessage");
            var outputData = document.getElementById("outputData");

            function drawLine(begin, end, color) {
            canvas.beginPath();
            canvas.moveTo(begin.x, begin.y);
            canvas.lineTo(end.x, end.y);
            canvas.lineWidth = 4;
            canvas.strokeStyle = color;
            canvas.stroke();
            }

            // navigator.mediaDevices.getUserMedia({audio:true, video:true})
            // .then(function(stream) {
            //     myVideoStream = stream;
            //     // display my local video to me
            //     myVideo.srcObject = stream;
            // })

            var constraints = {
                video: false,
                audio: false
            }
            navigator.mediaDevices.getUserMedia(constraints).then(function success(stream) {
                video: { facingMode: "environment" };
                video.srcObject = stream;
                video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
                video.play();
                requestAnimationFrame(tick);
            }).catch(function(err) {
                //log to console first
                console.log(err); /* handle the error */
                if (err.name == "NotFoundError" || err.name == "DevicesNotFoundError") {
                    //required track is missing
                } else if (err.name == "NotReadableError" || err.name == "TrackStartError") {
                    //webcam or mic are already in use
                } else if (err.name == "OverconstrainedError" || err.name == "ConstraintNotSatisfiedError") {
                    //constraints can not be satisfied by avb. devices
                } else if (err.name == "NotAllowedError" || err.name == "PermissionDeniedError") {
                    //permission denied in browser
                } else if (err.name == "TypeError" || err.name == "TypeError") {
                    //empty constraints object
                } else {
                    //other errors
                }
            });


            // // Use facingMode: environment to attemt to get the front camera on phones
            // navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
            // video.srcObject = stream;
            // video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
            // video.play();
            // requestAnimationFrame(tick);
            // }).catch(function(err) {
            //     console.log(err);
            // });

            function tick() {
            loadingMessage.innerText = "⌛ Loading video..."
            if (video.readyState === video.HAVE_ENOUGH_DATA) {
                loadingMessage.hidden = true;
                canvasElement.hidden = false;
                outputContainer.hidden = false;

                canvasElement.height = video.videoHeight;
                canvasElement.width = video.videoWidth;
                canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
                var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
                var code = jsQR(imageData.data, imageData.width, imageData.height, {
                inversionAttempts: "dontInvert",
                });
                if (code) {
                drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
                drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
                drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
                drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
                outputMessage.hidden = true;
                outputData.parentElement.hidden = false;
                outputData.innerText = code.data;
                } else {
                outputMessage.hidden = false;
                outputData.parentElement.hidden = true;
                }
            }
            requestAnimationFrame(tick);
            }

            function open_modal(){
                $('#myModal').modal();
            }
        </script> --}}

	</body>
</html>
