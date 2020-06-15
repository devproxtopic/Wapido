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

	<body>
        <input type="hidden" name="message" id="message"
            @if(session("message")) value="{{ session("message") }}" @endif>
        <input type="hidden" id="url_base" value="{{ url('') }}">
        <input type="hidden" id="slug" value="{{ $owner->slug }}">
        <div id="fixed-bg"></div>
        <br>
        <div >
            <center>
				<div>
                    <img src="{{ asset('img/wapido_logo2.png') }}" width="30%">
                </div>
            </center>
        </div>

        <h1>Por favor indique su número de mesa</h1>
    <section>
        <ul class="first-list final">
            <li>
                <p>Para continuar al menú debe escanear el Qr con su número de mesa.</p><br>
                <div id="loadingMessage">🎥 No se puede acceder a la camara, revise los permisos.</div>
            </li>
            <li>
                <canvas id="canvas" hidden></canvas>
                <div id="output" hidden>
                    <div id="outputMessage">No se ha detectado código Qr.</div>
                    <div hidden><b>Siga el siguiente enlace:</b> <a id="outputData" href=""></a></div>
                </div>
            </li>
            <li>
                <div>Si el lector de Qr no abre, seleccione un número de la lista de mesas.</span>
                <form>
                    <select required name="table_selected" id="table_selected" class="select2 form-control">
                        <option value="">Lista de mesas</option>
                        @foreach ($owner->tables as $item)
                        <option value="{{ $item->number }}">Mesa número: {{ $item->number }}</option>
                        @endforeach
                    </select>

                    <div id="confirmTable" style="display: none;">
                        <br>
                        <center>
                            <a id="redirectMainDigital" href="#" class="calc">CONFIRMAR MESA</a>
                        </center>
                    </div>
                </form>
            </li>
        </ul>
    </section>
        <script src="{{ asset('js/ajax/locations.js') }}"></script>

		<footer>
        <center><img src="{{ asset('img/logo.png') }}" width="15%"></center> <br>
			<h5>{{-- Blvd. Campestre 1907 <br>
			Col. Valle del Campestre, León, Gto.<br>
			Tel.: 477 717 64 32 <br> --}}
			info@wapido.com</h5>
			<!--<h6>Comparti tu experiencia en: <a href="http://www.tripadvisor.es/Restaurant_Review-g294323-d1804509-Reviews-Facal-Montevideo_Montevideo_Department.html" target="_blank"><img src="img/trip-advisor.svg" alt=""></a> <a href="https://www.facebook.com/BarFacal" target="_blank"><i class="fa fa-facebook-official"></i></a></h6>-->
        </footer>

        <script>
        $(document).ready(function() {
            $('#table_selected').change(function(){

                if($('#confirmTable').css('display', 'none')){
                    $('#confirmTable').css('display', 'block');
                    if($(this).val() != ''){
                        var url = $('#url_base').val() + '/' + $('#slug').val() + '?table=' + $(this).val();
                        $('#redirectMainDigital').attr('href', url);
                    } else {
                        $('#redirectMainDigital').attr('href', "#");
                    }
                } else {
                    $('#confirmTable').css('display', 'none');
                }

            });
        });
        </script>

        <script>
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

            // Use facingMode: environment to attemt to get the front camera on phones
            navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
            video.srcObject = stream;
            video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
            video.play();
            requestAnimationFrame(tick);
            });

            function tick() {
                loadingMessage.innerText = "⌛ Cargando video..."
                if (video.readyState === video.HAVE_ENOUGH_DATA) {
                    loadingMessage.hidden = true;
                    canvasElement.hidden = false;
                    outputContainer.hidden = false;

                    canvasElement.height = 400;
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
                    outputData.setAttribute('href', code.data);
                } else {
                    outputMessage.hidden = false;
                    outputData.parentElement.hidden = true;
                }
            }
            requestAnimationFrame(tick);
            }

        </script>
	</body>
</html>
