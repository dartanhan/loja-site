<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    public $table = 'loja_pedidos';
    protected $fillable = ['status', 'user_id'];


    public function pedido_produto_item()
    {
        return $this->hasMany(PedidoProduto::class, 'pedido_id');
    }

    public function consultaPedido($value)
    {
        $pedido = self::where($value)->first();
        return !empty($pedido->id)? $pedido->id : null;
    }

}
