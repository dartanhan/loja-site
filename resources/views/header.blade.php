@section('menu')
    @include('menu')
@endsection
@section('header')
    <div>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <i class="fas fa-shopping-bag mr-2"></i>
                    Catálogo KN Cosméticos
                </a>
                @yield('menu')
            </div>
        </nav>
    </div>
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
@endsection
