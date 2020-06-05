@extends('layouts.extern')

@section('content')

<div class="limiter">
    <div class="container-login100">
        <div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div>
        <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
            <span class="login100-form-title p-b-39">
                <center>
                <img src="{{ asset("img/logo.png") }}" alt="logo">
                </br>
                Registro de Negocios
                </center>
            </span>

            <div class="container">

                <center>
                <div class="stepwizard col-md-offset-3">
                    <div class="stepwizard-row setup-panel">
                        <div class="stepwizard-step">
                            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                            <p>Paso 1</p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                            <p>Paso 2</p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                            <p>Paso 3</p>
                        </div>
                    </div>
                </div>
                </center>

                <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row setup-content" id="step-1">
                        <div class="wrap-input100 validate-input" data-validate="El nombre es requerido">
						<span class="label-input100">Nombre Contacto</span>
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

                        @error('email')
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

                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Siguiente</button>
                    </div>
                    <div class="row setup-content" id="step-2">

					<div class="wrap-input100 validate-input" data-validate="El nombre de la empresa es requerido">
						<span class="label-input100">Nombre Empresa</span>
						<input class="input100" type="text" name="username" placeholder="Empresa">
                        <span class="focus-input100"></span>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="wrap-input100" data-validate="El tipo de empresa es requerido">
                        <span class="label-input100">Tipo de Empresa</span>
                        <select required class="input100" name="category_owner_id" id="category_owner_id">
                            <option value="0">Seleccione una opción</option>
                            @foreach(App\Models\CategoryOwner::all() as $co)
                            <option @if( old('category_owner_id') == $co->id) selected @endif value="{{ $co->id }}">
                            {{ $co->name }}
                            </option>
                            @endforeach
                        </select>

                        @error('category_owner_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Siguiente</button>

                    </div>
                    <div class="row setup-content" id="step-3">

                        <div class="wrap-input100" data-validate="El pais es requerido">
                            <span class="label-input100">Pais</span>
                            <select required class="form-control" name="country_id" id="country_id">
                                <option value="0">Seleccione una opción</option>
                                @foreach(App\Models\Country::all() as $country)
                                <option @if( old('country_id') == $country->id) selected @endif value="{{ $country->id }}">
                                {{ $country->name }}
                                </option>
                                @endforeach
                            </select>

                            @error('country_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="wrap-input100" data-validate="El estado es requerido">
                            <span class="label-input100">Estado</span>
                            <select required class="form-control" name="state_id" id="state_id">
                                {{-- SE LLENA CON AJAX --}}
                            </select>

                            @error('state_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="wrap-input100" data-validate="La ciudad es requerida">
                            <span class="label-input100">Ciudad</span>
                            <select required class="form-control" name="city_id" id="city_id">
                                {{-- SE LLENA CON AJAX --}}
                            </select>

                            @error('city_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="wrap-input100" data-validate="La localidad es requerida">
                            <span class="label-input100">Localidad</span>
                            <select required class="form-control" name="location_id" id="location_id">
                                {{-- SE LLENA CON AJAX --}}
                            </select>

                            @error('location_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
                    </div>
                </form>

            </div>
                    <!-- /.Horizontal Steppers -->
			</div>
		</div>
	</div>

    @stop

@section('scripts')
<script src="{{ asset('js/ajax/locations.js') }}"></script>
<script>
    $(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-primary').addClass('btn-default');
          $item.addClass('btn-primary');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      if (isValid)
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-primary').trigger('click');
});
</script>
@stop
