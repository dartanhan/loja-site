<?php

namespace App\Http\Livewire;

use App\Models\Pedido;
use App\Models\PedidoProduto;
use Livewire\Component;

class CartShow extends Component
{
    public $pedidos, $mensagem_erro;

    protected $listeners = ['removeItemToCart','removeItemToCart'];

    public function mount(){

    }

    private function validaQtd(int $idPedidoItem){
        $this->pedidos = Pedido::join("loja_pedido_produtos as pp", "loja_pedidos.id", "=", "pp.pedido_id")
            ->join("loja_produtos_variacao as pv", "pp.produto_id", "=", "pv.id")
            ->select(
                "pv.quantidade as qtdTotalProduto",
                "pp.quantidade as quantidadeItem")
            ->where([
                'loja_pedidos.status'  => 'RE',
                'loja_pedidos.user_id' => auth()->user()->id,
                'pp.id' => $idPedidoItem//auth()->user()->id
            ])->first();
        return $this->pedidos;
    }

    /**
     * Decrementa a quantidde no carrinho
     * @param int $idPedidoItem
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
     * PErgunta se deseja remover o ítem
     * @param $pedidoProdutoId
     */
    public function confirmRemoveItem($pedidoProdutoId)
    {
        $this->emit('confirmRemoveItem', $pedidoProdutoId);
    }

    public function removeItemToCart(int $idPedidoItem){
        $item = PedidoProduto::with('pedido')->findOrFail($idPedidoItem);
     
        if ($item) {
            $item->delete();
        }

        $this->emit('mensagem', [
            'titulo' => 'Produto removido com sucesso!',
            'icon' => 'success']);
    }

    /**
     * Incrementa a quantidade no carrinho
     * @param int $idPedidoItem
     * @return bool
     */
    public function incrementQuantity(int $idPedidoItem){
        if(auth()->check()) {

            $retorno = $this->validaQtd($idPedidoItem);

            if ($retorno->quantidadeItem > $retorno->qtdTotalProduto) {
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
        }else{
            return redirect('../login');// Redireciona para a rota de login
        }
    }



    /**
    * Busca os íntens do carrinho
     */
    public function loadPedidos()
    {
        $this->pedidos = Pedido::with(['pedido_produto_item.produto_variacao.imagens','pedido_produto_item.produto_variacao.produto'])
            ->where([
                'status'  => 'RE',
                'user_id' => auth()->user()->id
            ])->get();

        
    }

    public function render()
    {
        // atualiza a quantidade no carrinho
        $this->emit('checkCartCount');
        $this-> loadPedidos();
        return view('livewire.cart.cart-show',
            [
            'pedidos' => $this->pedidos
            ]
        );

    }

}
