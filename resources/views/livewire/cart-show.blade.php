<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="container-fluid tm-container-content tm-mt-60">
        <div class="row">
            @if(count($pedidos) > 0)
                <div class="card">
                    <h5 class="card-header">Produtos do carrinho - Pedido : {{ $pedidos[0]->id}} - Criado em :  {{ $pedidos[0]->created_at->format('d/m/Y H:i')}}</h5>
                    <div class="card-body">

                        @foreach ($pedidos as $pedido)
                            <div class="row">
                                <table class="table table-hover table-striped">
                                    <thead class="thead-rose">
                                    <tr>
                                        <th scope="col">Imagem</th>
                                        <th scope="col">Produto</th>
                                        <th scope="col">Qtd</th>
                                        <th scope="col">Valor Unit.</th>
                                        <th scope="col">Desconto(s)</th>
                                        <th scope="col">SubTotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total_pedido = 0;
                                    @endphp

                                    @foreach ($pedido->pedido_produto_item as $pedidosProdutos )
                                        {{$pedidosProdutos->produto_variacao->quantidade}}
                                        <tr>
                                            <td>
                                                @if(!is_null($pedidosProdutos->produto_variacao->produto_variacao_image))
                                                    <img src="{{URL::asset(env('ASSET_URL_IMAGE_CATEGORIA_PRODUTO_SITE').'/'.$pedidosProdutos->produto_variacao->produto_variacao_image->path)}}"
                                                         width="80px" height="80px"
                                                         title="{{ $pedidosProdutos->produto_variacao->produto->descricao }} - {{ $pedidosProdutos->produto_variacao->variacao }}"
                                                         data-toggle="tooltip"/>
                                                @else
                                                    <img src="{{URL::asset(env('ASSET_URL_IMAGE_CATEGORIA_PRODUTO_SITE').'/not-image.png')}}"
                                                         width="50px" height="50px"
                                                         title="{{ $pedidosProdutos->produto_variacao->produto->descricao }} - {{ $pedidosProdutos->produto_variacao->variacao }}"
                                                         data-toggle="tooltip"/>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $pedidosProdutos->produto_variacao->produto->descricao }} - {{ $pedidosProdutos->produto_variacao->variacao }}
                                            </td>
                                            <td scope="row">
                                                @if($pedidosProdutos->quantidade > 1)
                                                    <a href="#" wire:click.prevent="decrementQuantity({{ $pedidosProdutos->id }})">
                                                        <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                                    </a>
                                                @else
                                                    <a href="#" class="disabled">
                                                        <i class="fa fa-minus-circle" aria-hidden="true" style="color: #ccc;"></i>
                                                    </a>
                                                @endif
                                                <span class="col-lg-4">{{ $pedidosProdutos->quantidade }}</span>

                                                    @if($pedidosProdutos->quantidade == $pedidosProdutos->produto_variacao->quantidade)
                                                        <a href="#" class="disabled">
                                                            <i class="fa fa-plus-circle" aria-hidden="true" style="color: #ccc;"></i>
                                                        </a>
                                                    @else
                                                        <a href="#"  wire:click.prevent="incrementQuantity({{$pedidosProdutos->id}})">
                                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                        </a>
                                                    @endif
                                            </td>
                                            <td>
                                                R$ {{number_format($pedidosProdutos->valor, 2, ',', '.')}}
                                            </td>
                                            <td>
                                                R$ {{number_format($pedidosProdutos->descontos, 2, ',', '.')}}
                                            </td>
                                            @php
                                                /** @var TYPE_NAME $pedidosProdutos */
                                                $total_produto = ($pedidosProdutos->quantidade * $pedidosProdutos->valor)-$pedidosProdutos->descontos;
                                                $total_pedido  += $total_produto;
                                            @endphp
                                            <td>
                                                R$ {{number_format($total_produto, 2, ',', '.')}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <hr>
                                <div class="col-lg-4">
                                    <form action="{{route('produto-detalhe-variacoes')}}" method="post">
                                        {!! csrf_field() !!}
                                        <button class="btn btn-block btn-info"  type="submit">CONTINUAR COMPRANDO</button>
                                    </form>
                                </div>
                                <div class="col-lg-4">
                                    <form action="{{route('cart.store')}}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="pedido_id" value="{{$pedido->id}}">
                                        <button class="btn btn-block btn-danger" type="submit">CONCLUIR COMPRAS</button>
                                    </form>
                                </div>
                                <div class="jumbotron jumbotron-fluid col-lg-4">
                                    <div class="container">
                                        <h1 class="display-5">Total do pedido R$:   {{number_format($total_pedido, 2, ',', '.')}}</h1>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="container not-found">
                    <h1>Ops! O carrinho está vazio.</h1>
                    <p>Adicone itens ao carrinho e boa compras!</p>
                    <p><a href="#" onclick="postLink('{{ route('produto-detalhe-variacoes')}}')">Voltar para a página anterior</a></p>
                    <img src="{{URL::asset('img/logo.png')}}" alt="Produto Não Encontrado" class="img-fluid">
                </div>

            @endif
        </div>
    </div>
</div>
