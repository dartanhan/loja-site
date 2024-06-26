<?php

namespace App\Models;

use App\Models\ProdutoVariation1;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static select(string $string, string $string1, string $string2)
 */
class ProdutoImagem extends Model
{
    public $table = 'loja_produtos_imagens';
    protected $fillable = ['produto_variacao_id','path'];

    public function images_variacao() {
        return $this->hasMany(ProdutoVariation::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
