<!DOCTYPE html>
<html lang="en" xmlns:livewire="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="KN Cosméticos" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KN Cosméticos</title>

    <link rel="stylesheet" href="{{URL::asset('css/bootstrap/bootstrap.css')}}">
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

@yield('header')

<div class="container-fluid tm-container-content tm-mt-60">
    @yield('content')
</div> <!-- container-fluid, tm-container-content -->

<footer class="tm-bg-gray pt-5 pb-3 tm-text-gray tm-footer">
    @yield('footer')
</footer>

<script src="{{URL::asset('js/jquery-3.2.1.slim.min.js')}}"></script>
<script src="{{URL::asset('js/popper.min.js.js')}}"></script>
<script src="{{URL::asset('js/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('js/plugins.js')}}"></script>
<script src="{{URL::asset('js/url.js')}}"></script>
<script src="{{URL::asset('js/scripts.js')}}"></script>
<script src="{{URL::asset('js/http.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- JQuery -->


<!-- Bootstrap Bundle JS -->
<script src="{{URL::asset('js/bootstrap/bootstrap.bundle.js')}}"></script>
<script>
    $(window).on("load", function() {
        $('body').addClass('loaded');
        $('[data-toggle="tooltip"]').tooltip();

    });
</script>
@livewireScripts
</body>
</html>
