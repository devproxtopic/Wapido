@extends('layouts.admin')

@section('title', 'Actualizar Sucursal')
@section('display_create', 'display:none;')

@section('content')
<div class="col-sm-12 col-md-12">
    <form method="POST" action="{{ url('owners/'. $owner->slug .'/branches/' . $branch->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="country_id" class="col-md-4 col-form-label text-md-right">País</label>

            <div class="col-md-6">
                <select required class="form-control @error('country_id') is-invalid @enderror" name="country_id" id="country_id">
                    <option value="0">Seleccione una opción</option>
                    @foreach($countries as $country)
                    <option @if($branch->country_id == $country->id) selected @endif value="{{ $country->id }}">
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
        </div>

        <div class="form-group row">
            <label for="state_id" class="col-md-4 col-form-label text-md-right">Estado</label>

            <div class="col-md-6">
                <select required class="form-control @error('state_id') is-invalid @enderror"
                    name="state_id" id="state_id">
                    @foreach ($countries->find($branch->country_id)->states as $state)
                    <option @if($state->id == $branch->state_id) selected @endif
                        value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                    {{-- SE LLENA CON AJAX--}}
                </select>

                @error('state_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="city_id" class="col-md-4 col-form-label text-md-right">Ciudad</label>

            <div class="col-md-6">
                <select required class="form-control @error('city_id') is-invalid @enderror"
                name="city_id" id="city_id">
                    @foreach ($countries->find($branch->country_id)->states->find($branch->state_id)->cities as $city)
                    <option @if($city->id == $branch->city_id) selected @endif
                        value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                    {{-- SE LLENA CON AJAX--}}
                </select>

                @error('city_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="location_id" class="col-md-4 col-form-label text-md-right">Localidad</label>

            <div class="col-md-6">
                <select required class="form-control @error('location_id') is-invalid @enderror"
                name="location_id" id="location_id">
                    @foreach ($countries->find($branch->country_id)->states->find($branch->state_id)->cities->find($branch->city_id)->locations as $location)
                    <option @if($location->id == $branch->location_id) selected @endif
                        value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                    {{-- SE LLENA CON AJAX--}}
                </select>

                @error('location_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                name="name" value="{{ $branch->name }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="address" class="col-md-4 col-form-label text-md-right">Dirección</label>

            <div class="col-md-6">
                <textarea required name="address" class="form-control @error('address') is-invalid @enderror"
                id="address" cols="30" rows="10">{{ $branch->address }}</textarea>

                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="phone" class="col-md-4 col-form-label text-md-right">Teléfono</label>

            <div class="col-md-6">
                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $branch->phone }}" required autocomplete="phone" autofocus>

                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $branch->email }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="ubication_google_maps" class="col-md-4 col-form-label text-md-right">Ubicación (Google Maps)</label>

            <div class="col-md-6">
                <input id="ubication_google_maps" type="text" class="form-control @error('ubication_google_maps') is-invalid @enderror" name="ubication_google_maps" value="{{ $branch->ubication_google_maps }}" required autocomplete="ubication_google_maps" autofocus>

                @error('ubication_google_maps')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="quantity_people" class="col-md-4 col-form-label text-md-right">Cantidad de Personas</label>

            <div class="col-md-6">
                <input id="quantity_people" type="text" class="form-control @error('quantity_people') is-invalid @enderror" name="quantity_people" value="{{ $branch->quantity_people }}" required autocomplete="quantity_people" autofocus>

                @error('quantity_people')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="quantity_tables" class="col-md-4 col-form-label text-md-right">Cantidad de Mesas</label>

            <div class="col-md-6">
                <input id="quantity_tables" type="text" class="form-control @error('quantity_tables') is-invalid @enderror" name="quantity_tables" value="{{ $branch->quantity_tables }}" required autocomplete="quantity_tables" autofocus>

                @error('quantity_tables')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="field_wrapper">
            <div class="form-group row">
                <label for="zipcodes" class="col-md-4 col-form-label text-md-right">Código Postal</label>

                <div class="col-md-6">
                    <input type="text" class="form-control @error('zipcodes') is-invalid @enderror" name="zipcodes[]">

                    <a href="javascript:void(0);" class="add_button" title="Añadir">Añadir otro Código Postal</a>

                    @error('zipcodes')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
                <a href="{{ url('owners/'. $owner->slug .'/branches') }}" class="btn btn-warning">
                    Volver
                </a>
            </div>
        </div>
    </form>
</div>
@stop

@section('scripts')
<script src="{{ asset('js/ajax/locations.js') }}"></script>
<script>
    $(document).ready(function(){
        var zipcodes = @json($zipcodes);

    if(zipcodes){
        for (let index = 0; index < zipcodes.length; index++) {

            var wrapper = $('.field_wrapper'); // Contenedor de campos
            var fieldHTML = '<div class="form-group row">'+
                    '<label for="zipcodes" class="col-md-4 col-form-label text-md-right">Código Postal</label>'+
                    '<div class="col-md-6">'+
                    '<input readonly type="text" class="form-control @error("zipcodes") is-invalid @enderror" name="zipcodes[]" required value="' + zipcodes[index].zipcode + '">'+
                    '</div>'+
                    '<a href="javascript:void(0);" class="remove_button" title="Borrar"><i class="fa fa-trash"></i></div>';

            $(wrapper).append(fieldHTML); // Añadimos el HTML

        }
    }


        var maxField = 10; // Numero maximo de campos
        var addButton = $('.add_button'); // Selector del boton de Insertar
        var wrapper = $('.field_wrapper'); // Contenedor de campos
        var fieldHTML = '<div class="form-group row">'+
                    '<label for="zipcodes" class="col-md-4 col-form-label text-md-right">Código Postal</label>'+
                    '<div class="col-md-6">'+
                    '<input type="text" class="form-control @error("zipcodes") is-invalid @enderror" name="zipcodes[]" required>'+
                    '</div>'+
                    '<a href="javascript:void(0);" class="remove_button" title="Borrar"><i class="fa fa-trash"></i></div>'; //New input field html
        var x = 1; // Iniciamos el contador a 1
        $(addButton).click(function(){ // Una vez que se haga clic en el boton
            if(x < maxField){ //Comprobamos el maximo
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); // Añadimos el HTML
            }
        });
        $(wrapper).on('click', '.remove_button', function(e){ // Una vez se ha hecho clic en el boton de eliminar
            e.preventDefault();
            $(this).parent('div').remove(); //Eliminamos el div
            x--; // Reducimos el contador a 1
        });
    });
</script>
@stop
