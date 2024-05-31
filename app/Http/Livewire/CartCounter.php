<?php

namespace App\Http\Livewire;

use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartCounter extends Component
{
    public $totalCart =0;
    public $pedidos;

    protected $listeners = ['checkCartCount','checkCartCount'];

    public function checkCartCount(){
        if(Auth::check()){
            $this->pedidos = Pedido::with(['pedido_produto_item'])
                ->where([
                    'status'  => 'RE',
                    'user_id' => auth()->user()->id
                ])->get();

            return $this->pedidos[0]['pedido_produto_item']->count();
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
