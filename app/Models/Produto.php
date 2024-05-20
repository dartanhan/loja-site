<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    public $table = 'loja_produtos_new';
    protected $fillable = [];

    // Definir o relacionamento com ProdutoVariacao
    public function variacoes()
    {
        return $this->hasMany(ProdutoVariation::class, 'products_id');
    }
}
