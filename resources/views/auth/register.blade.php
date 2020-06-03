@extends('layouts.extern')

@section('content')

	<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
                <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                @csrf
					<span class="login100-form-title p-b-39">
					<center><img src="{{ asset("img/logo.png") }}" alt="logo">
						</br>
						Registro de Negocios
						</center>
					</span>

					<div class="wrap-input100 validate-input" data-validate="El nombre es requerido">
						<span class="label-input100">Nombre</span>
						<input class="input100" type="text" name="name" placeholder="Nombre Completo">
                        <span class="focus-input100"></span>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

					</div>

					<div class="wrap-input100 validate-input" data-validate = "Debe ingresar un email valido: ex@abc.xyz">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Email@...">
                        <span class="focus-input100"></span>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>

					<div class="wrap-input100 validate-input" data-validate="El nombre de la empresa es requerido">
						<span class="label-input100">Empresa</span>
						<input class="input100" type="text" name="username" placeholder="Empresa">
                        <span class="focus-input100"></span>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>

					<div class="wrap-input100 validate-input" data-validate = "La contraseña es requerida">
						<span class="label-input100">Contraseña</span>
						<input class="input100" type="password" name="password" placeholder="*************">
                        <span class="focus-input100"></span>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>

					<div class="wrap-input100 validate-input" data-validate = "La confirmación de la contraseña es requerida">
						<span class="label-input100">Reingrese Password</span>
						<input class="input100" type="password" name="password_confirmation" placeholder="*************">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-m w-full p-b-33">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								<span class="txt1">
									Estoy de acuerdo con los
									<a href="#" class="txt2 hov1">
										Términos y Condiciones
									</a>
								</span>
							</label>
						</div>


					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">
								Registrarme
							</button>
						</div>

						<a href="{{ url('login') }}" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
							Acceder
							<i class="fa fa-long-arrow-right m-l-5"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

    @stop
