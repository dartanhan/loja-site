@extends('layouts.layout')

@section('content')
        @if(count($produtoDetalheVariacoes) >0)
          <div class="container-fluid tm-container-content tm-mt-60">
                <div class="row mb-4">
                    <nav aria-label="bread-crumb">
                        <ol class="bread-crumb">
                            <li class="bread-crumb-item"><a href="{{route('index')}}">HOME</a></li>
                            <li class="bread-crumb-item">CATEGORIA</li>
                            <li class="bread-crumb-item">
                                <a href="#" onclick="postLink('{{ route('produto-detalhe')}}' ,{{$produtoDetalheVariacoes[0]->categoria_id}})">{{$produtoDetalheVariacoes[0]->nome_categoria}}</a>
                            <li class="bread-crumb-item active" aria-current="page">{{$produtoDetalheVariacoes[0]->descricao}}</li>
                        </ol>
                    </nav>
                </div>

              <div class="row tm-mb-90 tm-gallery gallery">
                  @foreach($produtoDetalheVariacoes as $variacao)
                      <div class="gallery-item text-lef container-img">
                          <figure class="effect-ming tm-video-item effect-ming-detail">
                            <img src="{{URL::asset(env('ASSET_URL_IMAGE_CATEGORIA_PRODUTO_SITE').'/'.$variacao->path)}}" alt="Image" class="responsive">
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
                <!-- div class="row tm-mb-90 tm-gallery gallery">
                    @ foreach($produtoDetalheVariacoes as $variacao)
                        <div class="gallery-item">
                            <figure class="effect-ming tm-video-item effect-ming-detail">
                                <img src="{{URL::asset(env('ASSET_URL_IMAGE_CATEGORIA_PRODUTO_SITE').'/'.$variacao->path)}}" alt="Image" class="img-fluid">
                                <figcaption class="d-flex align-items-center justify-content-center">
                                    <h2>{{$variacao->descricao}} - {{$variacao->variacao}}</h2>
                                </figcaption>
                            </figure>
                            <div class="d-flex justify-content-between tm-text-gray">
                                <span class="tm-text-gray-light"></span>
                                <span>12,460 views</span>
                            </div>
                        </div>
                    @ endforeach
                </div-->
          </div>
        @else

            <div class="container not-found">
                <h1>Ops! Produto não encontrado</h1>
                <p>Lamentamos, mas o produto que você está procurando não foi encontrado.</p>
                <p><a href="#" onclick="postLink('{{ route('produto-detalhe')}}' ,{{$idCategorigoria}})">Voltar para a página anterior</a></p>
                <img src="{{URL::asset('img/logo.png')}}" alt="Produto Não Encontrado" class="img-fluid">

            </div>

        @endif
@endsection
@section('footer')
    @include('footer')
@endsection
