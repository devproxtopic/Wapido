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
    <div class="nav-wrapper">
      <ul class="nav flex-column">
        <li class="nav-item {{ (request()->segment(1) == 'home') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/home') }}">
            <i class="fa fa-cogs"></i>
            <span>Configuración</span>
          </a>
        </li>
        <li class="nav-item {{ (request()->segment(1) == 'promotions') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/promotions') }}">
              <i class="fa fa-star"></i>
              <span>Promociones</span>
            </a>
        </li>
        <li class="nav-item {{ (request()->segment(1) == 'categories') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/categories') }}">
            <i class="fa fa-wrench"></i>
            <span>Categorías</span>
          </a>
        </li>
        <li class="nav-item {{ (request()->segment(1) == 'items') ? 'active' : '' }}">
          <a class="nav-link " href="{{ url('/items') }}">
            <i class="fa fa-wrench"></i>
            <span>Productos</span>
          </a>
        </li>
        <li class="nav-item {{ (request()->segment(1) == 'clients') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/clients') }}">
              <i class="fa fa-users"></i>
              <span>Clientes</span>
            </a>
        </li>
        <li class="nav-item {{ (request()->segment(1) == 'orders') ? 'active' : '' }}">
            <a class="nav-link " href="{{ url('/orders') }}">
              <i class="fa fa-utensils"></i>
              <span>Pedidos</span>
            </a>
        </li>
        <li class="nav-item {{ (request()->segment(1) == 'units') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/units') }}">
              <i class="fa fa-edit"></i>
              <span>Unidades</span>
            </a>
        </li>
        <li class="nav-item {{ (request()->segment(1) == 'status') ? 'active' : '' }}">
            <a class="nav-link " href="{{ url('/status') }}">
              <i class="fa fa-edit"></i>
              <span>Estatus</span>
            </a>
        </li>
      </ul>
    </div>
  </aside>
