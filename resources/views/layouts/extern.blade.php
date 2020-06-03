<!DOCTYPE html>
    <html lang="es">
    <head>
        <title>Wapido</title>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
        <link rel="icon" type="image/png" href="{{ asset("img/favicon.ico") }}"/>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset("vendor/bootstrap/css/bootstrap.min.css") }}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset("fonts/font-awesome-4.7.0/css/font-awesome.min.css") }}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset("fonts/Linearicons-Free-v1.0.0/icon-font.min.css") }}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset("fonts/iconic/css/material-design-iconic-font.min.css") }}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset("vendor/animate/animate.css") }}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset("vendor/css-hamburgers/hamburgers.min.css") }}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset("vendor/animsition/css/animsition.min.css") }}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset("vendor/select2/select2.min.css") }}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset("vendor/daterangepicker/daterangepicker.css") }}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset("css/extern/util.css") }}">
        <link rel="stylesheet" type="text/css" href="{{ asset("css/extern/main.css") }}">
    <!--===============================================================================================-->
    </head>
    <body style="background-color: #999999;">

        @yield('content')


        <!--===============================================================================================-->
            <script src="{{ asset("vendor/jquery/jquery-3.2.1.min.js") }}"></script>
        <!--===============================================================================================-->
            <script src="{{ asset("vendor/animsition/js/animsition.min.js") }}"></script>
        <!--===============================================================================================-->
            <script src="{{ asset("vendor/bootstrap/js/popper.js") }}"></script>
            <script src="{{ asset("vendor/bootstrap/js/bootstrap.min.js") }}"></script>
        <!--===============================================================================================-->
            <script src="{{ asset("vendor/select2/select2.min.js") }}"></script>
        <!--===============================================================================================-->
            <script src="{{ asset("vendor/daterangepicker/moment.min.js") }}"></script>
            <script src="{{ asset("vendor/daterangepicker/daterangepicker.js") }}"></script>
        <!--===============================================================================================-->
            <script src="{{ asset("vendor/countdowntime/countdowntime.js") }}"></script>
        <!--===============================================================================================-->

        <script src="{{ asset("js/extern/main.js") }}"></script>

    </body>
</html>
