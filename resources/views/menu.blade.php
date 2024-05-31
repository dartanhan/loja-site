@section('menu')
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <!--li class="nav-item">
            <a class="nav-link nav-link-1 active" aria-current="page" href="index.html">Photos</a>
        </li-->
        <li class="nav-item">
            <a class="nav-link nav-link-2" href="{{ route('cart.index') }}" style="position: relative;">
                <i class="fas fa-shopping-cart mr-2"></i>
                Carrinho
                <span class="badge badge-light cart-badge"><livewire:cart-counter/></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-3" href="{{route('index')}}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-4" href="#">Contato</a>
        </li>

        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link nav-link-4" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link nav-link-4" href="{{ route('register') }}">{{ __('Cadastre-se') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</div>
@endsection
