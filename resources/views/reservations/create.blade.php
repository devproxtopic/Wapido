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
        <div id="fixed-bg"></div>
        <br>
        <div >
            <center>
				<div>
                    <img src="{{ asset('img/wapido_logo2.png') }}" width="30%">
                </div>
            </center>
        </div>

    <form action="{{ route('reservations.store', $owner->slug) }}" method="POST">
        @csrf

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

                <label for="">Fecha *</label>
                <input type="date" id="date" name="date" value="{{ old('date') }}" required placeholder="Fecha">

                <label for="">Hora de Inicio *</label>
                <input type="time" id="start_time" name="start_time" value="{{ old('start_time') }}" required placeholder="Hora de Inicio">

                <label for="">Mesa *</label>
                <select name="type_table" id="type_table" required>
                    <option value="">Seleccione una opción</option>
                    <option value="1">No Fumadores</option>
                    <option value="2">Con Niños</option>
                    <option value="3">Indistinto</option>
                </select>

				<span>Los campos marcados con * son obligatorios.</span>
                <button type="submit" id="submit_button">REALIZAR RESERVACION</button>
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
            <div class="modal-dialog modal-notify modal-success">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1>Su reservación ha sido realizada con éxito</h1>
                    </div>
                    <div class="modal-body">
                        <p>Este atento al correo de confirmación de la misma.</p>
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
                        <h1>Su reservación no puede realizarse</h1>
                    </div>
                    <div class="modal-body">
                        <p>Por favor introduzca una fecha diferente o una hora diferente. <br>
                        Horario de atención: {{ $owner->opening_hours }} - {{ $owner->closing_hours }} <br>
                        Gracias.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
                    </div>
                </div>
            </div>
        </div>


        @if(session("message"))
    <script>
            var type = "{{ session('alert-type') }}";
            switch(type){
                case 'info':
                    $('#errorModal').modal();
                    //toastr.info("{{ session('message') }}");
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
                    $('#myModal').modal();
                    break;
            }
    </script>
    @endif

	</body>
</html>
