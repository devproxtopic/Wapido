<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('/favicon.png') }}"/>

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Styles --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="{{ asset('template-admin/styles/shards-dashboards.1.1.0.css') }}">
    <link rel="stylesheet" href="{{ asset('template-admin/styles/extras.1.1.0.min.css') }}">
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    @yield('styles')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <script src="{{ asset('template-admin/scripts/extras.1.1.0.min.js') }}"></script>
    <script src="{{ asset('template-admin/scripts/shards-dashboards.1.1.0.min.js') }}"></script>
    <script src="{{ asset('template-admin/scripts/app/app-blog-overview.1.1.0.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @yield('scripts')

</head>
<body>
    <div class="container-fluid">
        <div class="row">

            @isset($owner)
                <input type="hidden" value="{{ $owner->id }}" name="owner_id" id="owner_id">
            @endisset
            @include('layouts.main')

            <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
                <div class="main-navbar sticky-top bg-white">

                    @include('layouts.header')

                </div>

                <input type="hidden" name="url_base" id="url_base" value="{{ url('') }}">

                <div class="main-content-container container-fluid px-4">

                    <div class="page-header row no-gutters py-4">
                        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                            <span class="text-uppercase page-subtitle">@yield('title')</span>
                            <h3 class="page-title">
                                <a href="@yield('route_create')" style="@yield('display_create')">
                                    Crear nuevo
                                </a>
                            </h3>
                        </div>
                    </div>

                    @yield('content')

                </div>

                @include('layouts.footer')

            </main>

        </div>
    </div>


    @if(session("message"))
    <script>
            var type = "{{ session('alert-type') }}";
            switch(type){
                case 'info':
                    toastr.info("{{ session('message') }}");
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
                    toastr.info("{{ session('message') }}");
                    break;
            }
    </script>
    @endif
</body>
</html>
