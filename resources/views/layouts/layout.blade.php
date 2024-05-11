<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="KN Cosméticos" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KN Cosméticos</title>
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/templatemo-style.css')}}">
    <!--

    TemplateMo 556 Catalog-Z

    https://templatemo.com/tm-556-catalog-z

    -->
</head>
<body>
<!-- Page Loader -->
<div id="loader-wrapper">
    <div id="loader"></div>

    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>

</div>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <i class="fas fa-shopping-bag mr-2"></i>
            Catálogo KN Cosméticos
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                <!--li class="nav-item">
                    <a class="nav-link nav-link-1 active" aria-current="page" href="index.html">Photos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-2" href="videos.html">Videos</a>
                </li-->
                <li class="nav-item">
                    <a class="nav-link nav-link-3" href="{{route('index')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-4" href="#">Contato</a>
                </li>
            </ul>
        </div>

    </div>
</nav>

<div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll">
    <div class="logo-container">
        <a href="{{route('index')}}">
            <img src="{{URL::asset('img/logo.png')}}" alt="Logo" class="img-fluid">
        </a>
    </div>
    <div class="text text-center mt-3">
        <h3>KN COSMÉTICOS</h3>
        <p>TUDO QUE UMA LASH PRECISA</p>
    </div>
</div>

<div class="container-fluid tm-container-content tm-mt-60">
    @yield('content')
</div> <!-- container-fluid, tm-container-content -->

<footer class="tm-bg-gray pt-5 pb-3 tm-text-gray tm-footer">
    @yield('footer')
</footer>

<script src="{{URL::asset('js/plugins.js')}}"></script>
<script src="{{URL::asset('js/scripts.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(window).on("load", function() {
        $('body').addClass('loaded');
        $('[data-toggle="tooltip"]').tooltip();

    });
</script>
</body>
</html>
