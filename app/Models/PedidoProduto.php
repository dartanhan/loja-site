<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{
    use HasFactory;

    public $table = 'loja_pedido_produtos';

    protected $fillable = ['status', 'valor', 'desconto', 'produto_id', 'pedido_id', 'cupom_desconto_id', 'quantidade'];

    public function produto_variacao()
    {
        return $this->belongsTo(ProdutoVariation::class, 'produto_id', 'id');
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($itemPedido) {
          
            $pedido = $itemPedido->pedido;

            // Verifica se o pedido não tem mais itens
            if ($pedido->pedido_produto_item()->count() == 0) {
                $pedido->delete();
            }
        });
    }
}
