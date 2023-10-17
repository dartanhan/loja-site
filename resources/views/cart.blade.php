@extends('layouts.layout')

@section('content')

    <div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class=" tm-text-primary text-css-produto">
                <span style="background-color: #fff; padding: 0 10px;">CARRINHO</span>
            </h2>
            {{$variacao_id->id}} - {{$variacao_id}}
        </div>
        <div class="row tm-mb-90 tm-gallery">

        </div>
    </div> <!-- container-fluid, tm-container-content -->

@endsection
@section('footer')
    @include('footer')
@endsection
