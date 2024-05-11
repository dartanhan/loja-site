@extends('layouts.layout')

@section('content')

    <div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class=" tm-text-primary text-css-produto">
                <span style="background-color: #fff; padding: 0 10px;">Carrinho de Compras</span>
            </h2>
        </div>
        <div class="row tm-mb-90 tm-gallery">
            @if (count($cartItems) > 0)
                <ul>
                    @foreach ($cartItems as $item)
                        <li>{{ $item['name'] }} - R${{ $item['price'] }}</li>
                    @endforeach
                </ul>
            @else
                <p>O carrinho está vazio.</p>
            @endif
        </div>
    </div> <!-- container-fluid, tm-container-content -->

@endsection
@section('footer')
    @include('footer')
@endsection
