{{--@extends('layouts.layout')--}}

@section('header')
    @include('header')
@endsection


{{--@section('content')--}}

    <div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class=" tm-text-primary text-css-produto">
                <span style="background-color: #fff; padding: 0 10px;">NOSSOS PRODUTOS</span>
            </h2>

        </div>
        <div class="row tm-mb-90 tm-gallery">
            <input type="hidden" name="categoria_id" value="1">
            <input type="hidden" name="produto_id" value="2">
            @foreach($categorias as $categoria)
        	<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="{{URL::asset(env('ASSET_URL_IMAGE_CATEGORIA_SITE').'/'.$categoria->id.'/'.$categoria->imagem)}}" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>{{$categoria->nome}}</h2>
                        <a href="#" onclick="postLink('{{ route('produto-detalhe')}}' , {{$categoria->id}})"></a>
                    </figcaption>
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light"></span>
                    <span>12,460 views</span>
                </div>
            </div>
            @endforeach
        </div> <!-- row -->
        <!--div class="row tm-mb-90">
            <div class="col-12 d-flex justify-content-between align-items-center tm-paging-col">
                <a href="javascript:void(0);" class="btn btn-primary tm-btn-prev mb-2 disabled">Previous</a>
                <div class="tm-paging d-flex">
                    <a href="javascript:void(0);" class="active tm-paging-link">1</a>
                    <a href="javascript:void(0);" class="tm-paging-link">2</a>
                    <a href="javascript:void(0);" class="tm-paging-link">3</a>
                    <a href="javascript:void(0);" class="tm-paging-link">4</a>
                </div>
                <a href="javascript:void(0);" class="btn btn-primary tm-btn-next">Next Page</a>
            </div>
        </div-->
    </div> <!-- container-fluid, tm-container-content -->

{{--@endsection--}}
@section('footer')
    @include('footer')
@endsection
