<div xmlns:wire="http://www.w3.org/1999/xhtml">
    @if(count($pedidos) > 0)
        <div class="card">
            <h5 class="card-header"><i class="fas fa-shopping-bag mr-2"></i> KN Cosméticos | Carrinho de Compras</h5>
            <div class="card-body">
                <div class="row">
                    <!-- Tabela de Itens -->
                    <div class="col-lg-8 mb-3">
                        <div>
                            <table class="table table-hover table-striped table-responsive-lg">
                                <thead class="thead-rose">
                                    <tr>
                                        <th scope="col" colspan="2"></th>
                                        <th scope="col">Qtd</th>
                                        <th scope="col">Valor Unit.</th>
                                        <th scope="col">Desconto(s)</th>
                                        <th scope="col">SubTotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pedidos as $pedido)
                                        @php $total_pedido = 0; @endphp
                                        @php $sub_total = 0; @endphp
                                        @php $total_descontos = 0; @endphp


                                        @foreach ($pedido->pedido_produto_item as $pedidosProdutos)
                                            <tr>
                                                <td colspan="2" class="text-left">
                                                    @if(!is_null($pedidosProdutos->produto_variacao->imagens))
                                                        <img src="{{ URL::asset(env('ASSET_URL_IMAGE_CATEGORIA_PRODUTO_SITE') . '/' . $pedidosProdutos->produto_variacao->imagens->path) }}"
                                                            width="80px" height="80px"
                                                            title="{{ $pedidosProdutos->produto_variacao->produto->descricao }} - {{ $pedidosProdutos->produto_variacao->variacao }}"
                                                            data-toggle="tooltip"/>&nbsp;&nbsp;  {{ $pedidosProdutos->produto_variacao->produto->descricao }} - {{ $pedidosProdutos->produto_variacao->variacao }}
{{--                                                    @else--}}
{{--                                                        <img src="{{ URL::asset(env('ASSET_URL_IMAGE_CATEGORIA_PRODUTO_SITE') . '/not-image.png') }}"--}}
{{--                                                            width="50px" height="50px"--}}
{{--                                                            title="{{ $pedidosProdutos->produto_variacao->produto->descricao }} - {{ $pedidosProdutos->produto_variacao->variacao }}"--}}
{{--                                                            data-toggle="tooltip"/>--}}
                                                    @endif
                                                </td>
                                                <td>
                                                    <span>
                                                        @if($pedidosProdutos->quantidade > 1)
                                                            <a href="#" title="Remover Item" data-toggle="tooltip" wire:click.prevent="decrementQuantity({{ $pedidosProdutos->id }})">
                                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                                            </a>
                                                        @else
                                                            <a href="#" class="disabled">
                                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                                            </a>
                                                        @endif
                                                        <span class="col-md-1">{{ $pedidosProdutos->quantidade }}</span>
                                                        @if($pedidosProdutos->quantidade == $pedidosProdutos->produto_variacao->quantidade)
                                                            <a href="#" class="disabled">
                                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                            </a>
                                                        @else
                                                            <a href="#" title="Adicionar Item" data-toggle="tooltip"
                                                                wire:click.prevent="incrementQuantity({{ $pedidosProdutos->id }})">
                                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                            </a>
                                                        @endif
                                                    </span>
                                                    <span class="col-md-1">
                                                        <a href="#" title="Excluir Item" data-toggle="tooltip"
                                                            wire:click.prevent="confirmRemoveItem({{ $pedidosProdutos->id }})">
                                                            <i class="fa fa-trash-alt text-danger" aria-hidden="true"></i>
                                                        </a>
                                                    </span>
                                                </td>
                                                <td>R$ {{ number_format($pedidosProdutos->valor, 2, ',', '.') }}</td>
                                                <td>R$ {{ number_format($pedidosProdutos->desconto, 2, ',', '.') }}</td>
                                                @php
                                                    /** @var TYPE_NAME $pedidosProdutos */
                                                    $total_produto = ($pedidosProdutos->quantidade * $pedidosProdutos->valor) - $pedidosProdutos->desconto;
                                                    $sub_total += ($pedidosProdutos->quantidade * $pedidosProdutos->valor) ;
                                                    /** @var TYPE_NAME $total_descontos */
                                                    $total_descontos += $pedidosProdutos->desconto;
                                                    $total_pedido  += $total_produto;
                                                @endphp
                                                <td>R$ {{ number_format($total_produto, 2, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Resumo do Pedido -->
                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <h2 class="card-header text-center font-weight-bold mb-2">Resumo</h2>
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <span>R$ {{ number_format($sub_total, 2, ',', '.') }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Descontos</span>
                                    <span>R$ {{ number_format($total_descontos, 2, ',', '.') }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Frete</span>
                                    <span>R$ {{ number_format(0, 2, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="card-footer" style="padding: 1px">
                                <div class="card-footer bg-rose text-white d-flex justify-content-between">
                                    <span class="font-weight-bold"> <h4>Total </h4></span>
                                    <span class="font-weight-bold"> <h4>R$ {{ number_format($total_pedido, 2, ',', '.') }} </h4></span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('produto-detalhe-variacoes') }}" method="post">
                                    {!! csrf_field() !!}
                                    <button class="btn btn-custom btn-block" type="submit">CONTINUAR COMPRANDO</button>
                                </form>
                                <form action="{{ route('cart.store') }}" method="POST" class="mt-2">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                                    <button class="btn btn-primary btn-block mt-4" type="submit">CHECKOUT</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container not-found">
            <h1>Ops! O carrinho está vazio.</h1>
            <p>Adicione itens ao carrinho e boas compras!</p>
            <p><a href="#" onclick="postLink('{{ route('produto-detalhe-variacoes') }}')">Voltar para a página anterior</a></p>
            <img src="{{ URL::asset('img/logo.png') }}" alt="Produto Não Encontrado" class="img-fluid">
        </div>
    @endif
</div>
