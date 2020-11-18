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
            @error('username')
                <span role="alert">
                    <strong>Nombre de empresa ya registrado</strong>
                </span>
            @enderror

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
                        <div class="wrap-input100 validate-input @error('name') alert-validate @enderror"
                        data-validate="@error('name') {{ $message }} @enderror | El nombre es requerido">
						<span class="label-input100">Nombre Contacto</span>
						<input class="input100" type="text" name="name" placeholder="Nombre Completo" value="{{ old('name') }}">
					</div>

                    <div class="wrap-input100 validate-input @error('email') alert-validate @enderror"
                        data-validate = "@error('email') {{ $message }} / @enderror Debe ingresar un email valido: ex@abc.xyz">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Email@..." value="{{ old('email') }}">
					</div>

                    <div class="wrap-input100 validate-input @error('password') alert-validate @enderror"
                    data-validate = "@error('password') {{ $message }} / @enderror La contraseña es requerida">
						<span class="label-input100">Contraseña</span>
						<input class="input100" type="password" name="password" placeholder="*************">
					</div>

                    <div class="wrap-input100 validate-input @error('password') alert-validate @enderror"
                    data-validate = "La confirmación de la contraseña es requerida">
						<span class="label-input100">Reingrese Password</span>
						<input class="input100" type="password" name="password_confirmation" placeholder="*************">
                    </div>

                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Siguiente</button>
                    </div>
                    <div class="row setup-content" id="step-2">

                    <div class="wrap-input100 validate-input @error('username') alert-validate @enderror"
                    data-validate="@error('username') {{ $message }} / @enderror El nombre de la empresa es requerido">
						<span class="label-input100">Nombre Empresa</span>
						<input class="input100" type="text" name="username" placeholder="Empresa" value="{{ old('username') }}">
                    </div>

                    <div class="wrap-input100 @error('category_owner_id') alert-validate @enderror"
                    data-validate="@error('category_owner_id') {{ $message }} / @enderror El tipo de empresa es requerido">
                        <span class="label-input100">Tipo de Empresa</span>
                        <select required class="form-control" name="category_owner_id" id="category_owner_id">
                            <option value="0">Seleccione una opción</option>
                            @foreach(App\Models\CategoryOwner::all() as $co)
                            <option @if( old('category_owner_id') == $co->id) selected @endif value="{{ $co->id }}">
                            {{ $co->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="wrap-input100 hours_owner @error('opening_hours') alert-validate @enderror"
                        data-validate="@error('opening_hours') {{ $message }} @enderror"
                        style="display: none;">
						<span class="label-input100">Horario de Apertura</span>
						<input class="input100" type="time" name="opening_hours" id="opening_hours" value="{{ old('opening_hours') }}">

                        @error('opening_hours')
                            <span role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="wrap-input100 hours_owner @error('closing_hours') alert-validate @enderror"
                        data-validate="@error('closing_hours') {{ $message }} @enderror"
                        style="display: none;">
						<span class="label-input100">Horario de Cierre</span>
						<input class="input100" type="time" name="closing_hours" id="closing_hours" value="{{ old('closing_hours') }}">

                        @error('closing_hours')
                            <span role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Siguiente</button>

                    </div>
                    <div class="row setup-content" id="step-3">

                        <div class="wrap-input100 @error('country_id') alert-validate @enderror"
                            data-validate="@error('country_id') {{ $message }} / @enderror El pais es requerido">
                            <span class="label-input100">Pais</span>
                            <select required class="form-control" name="country_id" id="country_id">
                                <option value="0">Seleccione una opción</option>
                                @foreach(App\Models\Country::all() as $country)
                                <option @if( old('country_id') == $country->id) selected @endif value="{{ $country->id }}">
                                {{ $country->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="wrap-input100 @error('state_id') alert-validate @enderror"
                            data-validate="@error('state_id') {{ $message }} / @enderror El estado es requerido">
                            <span class="label-input100">Estado</span>
                            <select required class="form-control" name="state_id" id="state_id">
                                @if(old('country_id'))
                                @foreach(App\Models\Country::find(old('country_id'))->states as $state)
                                <option @if(old('state_id') == $state->id) selected @endif value="{{ $state->id }}">
                                {{ $state->name }}
                                </option>
                                @endforeach
                                @endif
                                {{-- SE LLENA CON AJAX --}}
                            </select>
                        </div>

                        <div class="wrap-input100 @error('city_id') alert-validate @enderror"
                            data-validate="@error('city_id') {{ $message }} / @enderror La ciudad es requerida">
                            <span class="label-input100">Ciudad</span>
                            <select required class="form-control" name="city_id" id="city_id">
                                @if(old('country_id') && old('state_id'))
                                @foreach(App\Models\Country::find(old('country_id'))->states->find(old('state_id'))->cities as $city)
                                <option @if( old('city_id') == $city->id) selected @endif value="{{ $city->id }}">
                                {{ $city->name }}
                                </option>
                                @endforeach
                                @endif
                                {{-- SE LLENA CON AJAX --}}
                            </select>
                        </div>

                        <div class="wrap-input100 @error('location_id') alert-validate @enderror"
                            data-validate="@error('location_id') {{ $message }} / @enderror La localidad es requerida">
                            <span class="label-input100">Localidad</span>
                            <select required class="form-control" name="location_id" id="location_id">
                                @if(old('country_id') && old('state_id') && old('city_id'))
                                @foreach(App\Models\Country::find(old('country_id'))->states->find(old('state_id'))->cities->find(old('city_id'))->locations as $location)
                                <option @if( old('location_id') == $location->id) selected @endif value="{{ $location->id }}">
                                {{ $location->name }}
                                </option>
                                @endforeach
                                @endif
                                {{-- SE LLENA CON AJAX --}}
                            </select>
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

  $('#category_owner_id').change(function(){
        $('.hours_owner').css('display', 'none');
      if($(this).val() == 7){
        $('.hours_owner').css('display', 'block');
      }
  });
});
</script>
@stop
