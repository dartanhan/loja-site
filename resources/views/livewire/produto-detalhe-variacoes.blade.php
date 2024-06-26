@section('header')
    @include('header')
@endsection
<div>
        @if(count($produtoDetalheVariacoes) >0)
          <div class="container-fluid tm-container-content tm-mt-60">
                <div class="row mb-4">
                    <nav aria-label="bread-crumb">
                        <ol class="bread-crumb">
                            <li class="bread-crumb-item"><a href="{{route('index')}}">HOME</a></li>
                            <li class="bread-crumb-item"><a href="{{route('index')}}">CATEGORIA</a></li>
                            <li class="bread-crumb-item">
                                <a href="#" onclick="postLink('{{ route('produto-detalhe')}}' ,{{$produtoDetalheVariacoes[0]->categoria_id}})">{{$produtoDetalheVariacoes[0]->nome_categoria}}</a>
                            <li class="bread-crumb-item active" aria-current="page">{{$produtoDetalheVariacoes[0]->descricao}}</li>
                        </ol>
                    </nav>
                </div>

              <div class="row tm-mb-90 tm-gallery gallery">

                  @foreach($produtoDetalheVariacoes as $variacao)

                      <div class="gallery-item text-left container-img">
                          <figure class="effect-ming tm-video-item effect-ming-detail">
                            <img src="{{URL::asset(env('ASSET_URL_IMAGE_CATEGORIA_PRODUTO_SITE').'/'.$variacao->path)}}" alt="Image">
                              <figcaption class="d-flex align-items-center justify-content-center">
                                  <h2>{{$variacao->descricao}} - {{$variacao->variacao}}</h2>
                              </figcaption>
                          </figure>
                          <div class="d-flex justify-content-between tm-text-gray">
                              <span class="tm-text-gray-light"></span>
                              <span>12,460 views</span>
                          </div>

                          <div class="product-info">
                              <h3 class="product-title">{{$variacao->descricao}} <br> {{$variacao->variacao}}</h3>
                              <div class="price-info">
                                  <div class="price-details">
                                      <p>Varejo: <b>R$&nbsp;{{number_format($variacao->valor_varejo, 2, ',', '.') }}</b>&nbsp;|&nbsp;</p>
                                      <p data-toggle="tooltip" title="Para atacado quantidade deve ser maior ou igual a 5">Atacado &ges; 5: <b>R$&nbsp;{{number_format($variacao->valor_atacado, 2, ',', '.') }} </b></p>
                                  </div>
                              </div>
                              <div class="text-center">
                                   <div class="quantity--title--wI85xE8">Quantidade</div>
                                    <div class="comet-v2-input-number quantity--picker--OaDgLYT">
                                        <div class="comet-v2-input-number-btn">
                                            <span class="comet-icon comet-icon-subtract comet-v2-input-number-btn-disabled" data-quantityTotal="{{$variacao->quantidade}}">
                                                <svg viewBox="0 0 1024 1024" width="1em" height="1em" fill="currentColor"
                                                     aria-hidden="false" focusable="false" data-spm-anchor-id="a2g0o.detail.0.i7.34a2ocyCocyCTp">
                                                    <path d="M170.666667 506.666667c0-20.608 16.725333-37.333333
                                                        37.333333-37.333334h608a37.333333 37.333333 0 1 1 0 74.666667H208A37.333333 37.333333
                                                        0 0 1 170.666667 506.666667z">
                                                    </path>
                                                </svg>
                                            </span>
                                        </div>

                                        <input type="number"
                                               class="comet-v2-input-number-input"
                                               value="1"
                                               quantityTotal="{{$variacao->quantidade}}"
                                               id="quantidade-produto-{{$variacao->variacao_id}}" readonly/>

                                        <div class="comet-v2-input-number-btn">
                                            <span class="comet-icon comet-icon-add" data-quantityTotal="{{$variacao->quantidade}}">
                                                <svg viewBox="0 0 1024 1024" width="1em" height="1em" fill="currentColor" aria-hidden="false"
                                                     focusable="false" data-spm-anchor-id="a2g0o.detail.0.i6.34a2ocyCocyCTp">
                                                    <path d="M522.666667 844.8c-21.333333 0-38.4-17.066667-38.4-38.4l2.133333-270.933333-270.933333
                                                    2.133333c-21.333333 0-36.266667-17.066667-38.4-36.266667 0-21.333333 17.066667-38.4
                                                    36.266666-38.4l270.933334-2.133333 2.133333-270.933333c0-21.333333
                                                    17.066667-36.266667 38.4-36.266667s36.266667 17.066667 36.266667
                                                    38.4l-2.133334 270.933333 270.933334-2.133333c21.333333 0 36.266667
                                                    17.066667 38.4 36.266667 0 21.333333-17.066667 38.4-36.266667
                                                    38.4l-270.933333 2.133333-2.133334 270.933333c2.133333 19.2-14.933333 36.266667-36.266666 36.266667z">
                                                    </path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="quantity--info--jnoo_pD">
                                        <div>
                                            <span>{{$variacao->quantidade}} disponíveis</span>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button
                                            type="button"
                                            class="btn btn-custom btn-sm"
                                            onClick="addToCart({{ $variacao->variacao_id }},
                                                                    {{ $variacao->produto_id }},
                                                                    {{ $variacao->valor_varejo }},
                                                                    {{ $variacao->valor_atacado }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415
                                              11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5
                                              12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                            </svg>
                                            Adicionar ao Carrinho
                                        </button>
                                    </div>
                                    <div class="mt-1">
                                          <button
                                              type="button"
                                              class="btn btn-cart-view btn-sm" onclick="window.location.href='{{ route('cart.index') }}'">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                                  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                              </svg>
                                                Ver Carrinho
                                          </button>

                                    </div>
                              </div>

                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
        @else

            <div class="container not-found">
                <h1>Ops! Produto não encontrado</h1>
                <p>Lamentamos, mas o produto que você está procurando não foi encontrado.</p>
                <p><a href="#" onclick="postLink('{{ route('produto-detalhe')}}',{{$categoriaId}})">Voltar para a página anterior</a></p>
                <img src="{{URL::asset('img/logo.png')}}" alt="Produto Não Encontrado" class="img-fluid">

            </div>

        @endif
</div>
@section('footer')
    @include('footer')
@endsection
