<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
      <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
        <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
          <div class="d-table m-auto">
            <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 70px; width: 25%;" src="{{ asset('img/wapido_logo2.png') }}">
            <span class="d-none d-md-inline ml-1">Wapido</span>
          </div>
        </a>
        <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
          <i class="material-icons">&#xE5C4;</i>
        </a>
      </nav>
    </div>
    @if(request()->segment(1) != 'home')
    <div class="nav-wrapper">
      <ul class="nav flex-column">
        <li class="nav-item {{ (request()->segment(3) == 'promotions') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('owners/'.$owner->slug.'/promotions') }}">
              <i class="fa fa-star"></i>
              <span>Promociones</span>
            </a>
        </li>
        <li class="nav-item {{ (request()->segment(3) == 'categories') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('owners/'.$owner->slug.'/categories') }}">
            <i class="fa fa-wrench"></i>
            <span>Categorías</span>
          </a>
        </li>
        <li class="nav-item {{ (request()->segment(3) == 'items') ? 'active' : '' }}">
          <a class="nav-link " href="{{ url('owners/'.$owner->slug.'/items') }}">
            <i class="fa fa-wrench"></i>
            <span>Productos</span>
          </a>
        </li>
        <li class="nav-item {{ (request()->segment(3) == 'clients') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('owners/'.$owner->slug.'/clients') }}">
              <i class="fa fa-users"></i>
              <span>Clientes</span>
            </a>
        </li>
        <li class="nav-item {{ (request()->segment(3) == 'orders') ? 'active' : '' }}">
            <a class="nav-link " href="{{ url('owners/'.$owner->slug.'/orders') }}">
              <i class="fa fa-utensils"></i>
              <span>Pedidos</span>
            </a>
        </li>
        @if($owner->category_owner_id == 7)
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ (request()->segment(3) == 'foods' || request()->segment(3) == 'categories-food' ||
            request()->segment(3) == 'tables' || request()->segment(3) == 'employees' ||
            request()->segment(3) == 'reservations') ? 'active' : '' }}"
            href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Restaurante
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item {{ (request()->segment(3) == 'foods') ? 'active' : '' }}" href="{{ url('owners/'.$owner->slug.'/foods') }}">
                    <i class="fa fa-utensils"></i>
                    <span>Comidas</span>
                </a>
                <a class="dropdown-item {{ (request()->segment(3) == 'tables') ? 'active' : '' }}" href="{{ url('owners/'.$owner->slug.'/tables') }}">
                    <i class="fa fa-utensils"></i>
                    <span>Mesas</span>
                </a>
                <a class="dropdown-item {{ (request()->segment(3) == 'employees') ? 'active' : '' }}" href="{{ url('owners/' . $owner->slug . '/employees') }}">
                    <i class="fa fa-users"></i>
                    <span>Empleados</span>
                </a>
                <a class="dropdown-item {{ (request()->segment(3) == 'categories-food') ? 'active' : '' }}" href="{{ url('owners/'.$owner->slug.'/categories-food') }}">
                    <i class="fa fa-edit"></i>
                    <span>Categorias de Comida</span>
                </a>
                <a class="dropdown-item {{ (request()->segment(3) == 'reservations') ? 'active' : '' }}" href="{{ url('owners/'.$owner->slug.'/reservations') }}">
                    <i class="fa fa-edit"></i>
                    <span>Reservaciones</span>
                </a>
            </div>
        </li>
        @endif
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ (request()->segment(3) == 'units' || request()->segment(3) == 'status' || request()->segment(3) == 'categories-owner') ? 'active' : '' }}"
            href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Configuraciones
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item {{ (request()->segment(3) == 'units') ? 'active' : '' }}" href="{{ url('owners/'.$owner->slug.'/units') }}">
                    <i class="fa fa-edit"></i>
                    <span>Unidades</span>
                </a>
                <a class="dropdown-item {{ (request()->segment(3) == 'status') ? 'active' : '' }}" href="{{ url('owners/'.$owner->slug.'/status') }}">
                    <i class="fa fa-edit"></i>
                    <span>Estatus</span>
                </a>
                <a class="dropdown-item {{ (request()->segment(3) == 'categories-owner') ? 'active' : '' }}" href="{{ url('owners/'.$owner->slug.'/categories-owner') }}">
                    <i class="fa fa-edit"></i>
                    <span>Categorias de Negocio</span>
                </a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ (request()->segment(3) == 'countries' || request()->segment(3) == 'states'
            || request()->segment(3) == 'cities' || request()->segment(3) == 'locations') ? 'active' : '' }}"
            href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Ubicación
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item {{ (request()->segment(3) == 'countries') ? 'active' : '' }}" href="{{ url('owners/'.$owner->slug.'/countries') }}">
                    <i class="fa fa-globe"></i>
                    <span>Paises</span>
                </a>
                <a class="dropdown-item {{ (request()->segment(3) == 'states') ? 'active' : '' }}" href="{{ url('owners/'.$owner->slug.'/states') }}">
                    <i class="fa fa-globe"></i>
                    <span>Estados</span>
                </a>
                <a class="dropdown-item {{ (request()->segment(3) == 'cities') ? 'active' : '' }}" href="{{ url('owners/'.$owner->slug.'/cities') }}">
                    <i class="fa fa-globe"></i>
                    <span>Ciudades</span>
                </a>
                <a class="dropdown-item {{ (request()->segment(3) == 'locations') ? 'active' : '' }}" href="{{ url('owners/'.$owner->slug.'/locations') }}">
                    <i class="fa fa-globe"></i>
                    <span>Zonas</span>
                </a>
            </div>
        </li>
      </ul>
    </div>
    @endif
  </aside>
