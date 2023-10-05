@extends('layouts.layout')

@section('content')
          <div class="container-fluid tm-container-content tm-mt-60">
            <div class="row mb-4">
                <nav aria-label="bread-crumb">
                    <ol class="bread-crumb">
                        <li class="bread-crumb-item"><a href="{{route('index')}}">HOME</a></li>
                    <li class="bread-crumb-item">CATEGORIA</li>
                    <li class="bread-crumb-item"><a href="{{route('produto-datalhe',$produtoDetalheVariacoes[0]->categoria_id)}}">{{$produtoDetalheVariacoes[0]->nome_categoria}}</a></li>
                    <li class="bread-crumb-item active" aria-current="page">{{$produtoDetalheVariacoes[0]->descricao}}</li>
                </ol>
            </nav>
        </div>
        <div class="row tm-mb-90 tm-gallery">
            @foreach($produtoDetalheVariacoes as $variacao)
                <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6 col-8 mb-5">
                    <figure class="effect-ming tm-video-item effect-ming-detail">
                        <img src="{{URL::asset(env('ASSET_URL_IMAGE_CATEGORIA_PRODUTO_SITE').'/'.$variacao->path)}}" alt="Image" class="img-fluid img-max-height-300">
                        <figcaption class="d-flex align-items-center justify-content-center">
                            <h2>{{$variacao->descricao}} - {{$variacao->variacao}}</h2>
                        </figcaption>
                    </figure>
                    <div class="d-flex justify-content-between tm-text-gray">
                        <span class="tm-text-gray-light"></span>
                        <span>12,460 views</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('footer')
    @include('footer')
@endsection