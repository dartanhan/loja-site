<?php

namespace App\Http\Livewire;

use App\Models\Pedido;
use App\Models\PedidoProduto;
use Livewire\Component;

class CartShow extends Component
{
    public $pedidos, $mensagem_erro;

    protected $listeners = ['postAdded' =>'postAdded'];

    private function validaQtd(int $idPedidoItem){
        $this->pedidos = Pedido::join("loja_pedido_produtos as pp", "loja_pedidos.id", "=", "pp.pedido_id")
            ->join("loja_produtos_variacao as pv", "pp.produto_id", "=", "pv.id")
            ->select(
                "pv.quantidade as qtdTotalProduto",
                "pp.quantidade as quantidadeItem")
            ->where([
                'loja_pedidos.status'  => 'RE',
                'loja_pedidos.user_id' => 1,
                'pp.id' => $idPedidoItem//auth()->user()->id
            ])->first();
        return $this->pedidos;
    }

    /**
     * Decrementa a quantidde no carrinho
    */
    public function decrementQuantity(int $idPedidoItem){

        $item = PedidoProduto::find($idPedidoItem);
        if ($item) {
            $item->quantidade--;
            $item->save();

            $this->emit('mensagem', [
                'titulo' => 'Quantidade atualizada com sucesso!',
                'icon' => 'success']);
        }

    }
    /**
     * Incrementa a quantidade no carrinho
    */
    public function incrementQuantity(int $idPedidoItem){
        $retorno = $this->validaQtd($idPedidoItem);

        if($retorno->quantidadeItem > $retorno->qtdTotalProduto){
            $this->emit("mensagem", [
                'titulo' => 'Quantidade solicitada acima do estoque!',
                'icon' => 'error'
            ]);
            return false;
        }

        $item = PedidoProduto::find($idPedidoItem);
        if ($item) {
            $item->quantidade++;
            $item->save();

            $this->emit('mensagem', [
                                            'titulo' => 'Quantidade atualizada com sucesso!',
                                            'icon' => 'success']);
        }
    }

    public function render()
    {
        $this->pedidos = Pedido::with(['pedido_produto_item.produto_variacao.produto_variacao_image','pedido_produto_item.produto_variacao.produto'])
            ->where([
                'status'  => 'RE',
                'user_id' => 1//auth()->user()->id
            ])->get();

        return view('livewire.cart-show',
            [
                'pedidos' => $this->pedidos
            ]);
    }
}
