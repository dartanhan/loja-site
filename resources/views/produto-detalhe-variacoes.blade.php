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

                          <div class="product-info">
                              <h3>{{$variacao->descricao}} - {{$variacao->variacao}}</h3>
                              <p>Valor Varejo: R$&nbsp;{{number_format($variacao->valor_varejo, 2, ',', '.') }}</p>
                              <p>Valor Atacado: R$&nbsp;{{number_format($variacao->valor_atacado, 2, ',', '.') }}</p>
                              <p>Valor 5Un: R$&nbsp;{{number_format($variacao->valor_atacado_5un, 2, ',', '.') }}</p>
                              <p>Valor 10Un: R$&nbsp;{{number_format($variacao->valor_atacado_10un, 2, ',', '.') }}</p>
                          </div>
                          <div class="texto-produto mt-3">
                              <form action="{{route('cart.index')}}" method="post">
                                  <input type="hidden" id="variacao_id" name="variacao_id" value="{{$variacao->id}}}">
                                @csrf
                                  <button type="submit" class="btn btn-primary">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                          <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                      </svg>&nbsp;COMPRAR
                                  </button>
                              </form>

                         </div>
                      </div>
                  @endforeach
              </div>
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
