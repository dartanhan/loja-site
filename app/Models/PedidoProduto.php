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
}
