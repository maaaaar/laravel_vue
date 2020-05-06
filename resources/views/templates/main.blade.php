<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>

    <!-- para que vaya bootsrap -->
    <link rel="stylesheet" href="{{ asset ('css/app.css')}}">


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <a class="navbar-brand" href="#">Seguretat</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administrador</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="{{ url ('/rol')}}">Rols</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        @yield('principal')
    </div>
    <script src="{{ asset("js/app.js")}}"></script>
</body>
</html>
