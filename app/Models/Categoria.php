<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    public $table = 'loja_categorias';
    protected $fillable = [];

    // Definir o relacionamento com Produto
    public function produto()
    {
        return $this->hasMany(Produto::class, 'categoria_id');
    }

}
