@extends('layouts.extern')

@section('content')

	<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
                <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                @csrf
					<span class="login100-form-title p-b-39">
					<center><img src="{{ asset("img/logo.png") }}" alt="logo">
						</br>
						Inicio de Sesión de Negocios
						</center>
					</span>

                    <div class="wrap-input100 validate-input @error('email') alert-validate @enderror"
                        data-validate = "@error('email') {{ $message }} / @enderror Debe ingresar un email valido: ex@abc.xyz">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Email@...">
                        <span class="focus-input100"></span>
					</div>

                    <div class="wrap-input100 validate-input @error('password') alert-validate @enderror"
                        data-validate = "@error('password') {{ $message }} / @enderror La contraseña es requerida">
						<span class="label-input100">Contraseña</span>
						<input class="input100" type="password" name="password" placeholder="*************">
                        <span class="focus-input100"></span>
					</div>

					<div class="flex-m w-full p-b-33">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="remember" type="checkbox" name="remember">
							<label class="label-checkbox100" for="remember">
								<span class="txt1">
									Recuerdame
								</span>
							</label>
						</div>


					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">
								Acceder
							</button>
						</div>

						<a href="{{ url('register') }}" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
							Registrarme
							<i class="fa fa-long-arrow-right m-l-5"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

    @stop

