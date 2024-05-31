<?php

namespace App\Traits;

use App\Models\Pedido;
use App\Models\PedidoProduto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;
use Livewire\Livewire;

trait CartTrait
{
    use HasFactory;
    private $pedidoId;
    private $quantidade;

    public static function addCartTrait(array $products){

            $clienteId = auth()->user()->id;

            //Verifica se tem pedido para o usuário logado
            $pedidoId = Pedido::consultaPedido([
                'user_id' => $clienteId,
                'status'  => 'RE'
            ]);

            if(empty($pedidoId)):

                $newPedido = Pedido::create([
                    'user_id' =>  $clienteId,
                    'status'  => 'RE'
                ]);

                $pedidoId = $newPedido->id;
            else:

                $pedido = Pedido::with('pedido_produto_item')
                    ->where('user_id', $clienteId)
                    ->where('id', $pedidoId)
                    ->first();

                $item = $pedido->pedido_produto_item
                                        ->where('produto_id', $products['variacao_id'])
                                        ->where('pedido_id',$pedidoId)->first();

                if(!empty($item)):
                    $quantidade = $products['quantidade'] + $item->quantidade;

                    if($quantidade > $products['quantityTotal']){
                        return ['icon'=> 'warning','message' => 'Produto já adicionado ao carrinho! Estoque máximo de '.$products['quantityTotal'].' ítens'];
                    }
                endif;
            endif;

            //Cria o pedido ou atualiza quantidade
            $matchThese = empty($item) ?  array('id' => null) : array('id' => $item->id);
            $createPedidoProduto = PedidoProduto::updateOrCreate($matchThese, [
                'status'        => 'RE',
                'valor'         =>  ($products['quantidade'] >= 5) ? $products['valor_atacado'] : $products['valor_varejo'] ,
                'produto_id'    =>  $products['variacao_id'],
                'pedido_id'     =>  $pedidoId,
                'quantidade'     =>  empty($quantidade) ? $products['quantidade'] : $quantidade
            ]);


            if ($createPedidoProduto) {
                return ['icon'=> 'success','message' => 'Produto adicionado ao carrinho!'];
            }

            return ['icon'=> 'danger','message' => 'Falha ao adicionar o produto ao carrinho.'];

    }
}
