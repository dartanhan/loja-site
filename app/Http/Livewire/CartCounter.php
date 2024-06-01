<?php

namespace App\Http\Livewire;

use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function PHPUnit\Framework\isNull;

class CartCounter extends Component
{
    public $totalCart =0;
    public $pedidos;

    protected $listeners = ['checkCartCount','checkCartCount'];

    public function mount(){
        $this->totalCart = $this->checkCartCount();
    }

    public function checkCartCount(){
        if(Auth::check()){
            $this->pedidos = Pedido::with(['pedido_produto_item'])
                ->where([
                    'status'  => 'RE',
                    'user_id' => auth()->user()->id
                ])->get();
            
                $this->totalCart =0;
                if(!empty($this->pedidos[0]['pedido_produto_item'])){
                    $this->totalCart = $this->pedidos[0]['pedido_produto_item']->count();
                }
                
                return $this->totalCart;
        }else{
            return $this->totalCart;
        }

    }
    public function render()
    {
        $this->totalCart = $this->checkCartCount();
        return view('livewire.cart.cart-counter',[
            'totalCart' => $this->totalCart
        ]);
    }
}
