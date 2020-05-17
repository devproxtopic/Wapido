<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
      <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
        <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
          <div class="d-table m-auto">
            <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="{{ asset('img/logo.png') }}">
            <span class="d-none d-md-inline ml-1">{{ env('APP_NAME') }}</span>
          </div>
        </a>
        <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
          <i class="material-icons">&#xE5C4;</i>
        </a>
      </nav>
    </div>
    <div class="nav-wrapper">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/categories') }}">
            <i class="material-icons">edit</i>
            <span>Categorías</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ url('/items') }}">
            <i class="material-icons">vertical_split</i>
            <span>Productos</span>
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/clients') }}">
              <i class="material-icons">edit</i>
              <span>Clientes</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ url('/orders') }}">
              <i class="material-icons">vertical_split</i>
              <span>Pedidos</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/units') }}">
              <i class="material-icons">edit</i>
              <span>Unidades</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ url('/status') }}">
              <i class="material-icons">vertical_split</i>
              <span>Estatus</span>
            </a>
        </li>
      </ul>
    </div>
  </aside>
