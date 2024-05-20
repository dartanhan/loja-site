<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * @method static create($data)
 */
class ProdutoVariation extends Model
{
    protected $table = 'loja_produtos_variacao';
    protected $fillable = ['id','products_id','subcodigo','variacao','valor_varejo','valor_atacado','valor_atacado_5un','valor_atacado_10un','valor_lista','valor_produto'
                            ,'percentage','quantidade','quantidade_minima','status','validade','created_at','fornecedor','estoque'];

//    public function variations() {
//        return $this->belongsTo(ProdutoVariation::class);
//    }

    public function produto_variacao_image()
    {
        return $this->belongsTo(ProdutoImagem::class, 'id', 'produto_variacao_id');
    }

    // Definir o relacionamento com Produto
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'products_id');
    }
}
