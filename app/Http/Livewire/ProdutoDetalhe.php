<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Livewire\Component;

class ProdutoDetalhe extends Component
{
    public $categorias;
    public $categoriaId;

    public function mount(Request $request){
        $this->categoriaId = $request->input('categoria_id');
//        $this->produto_detalhe();
    }

    /***
     * Recebe o ID da categoria PAI (loja_categoria)
          * @return Application|Factory|View
     */
    public function produto_detalhe(){
        // Carrega as categorias com os produtos que têm imagens associadas e com status ativo
        $this->categorias = Categoria::where('id',  $this->categoriaId)
            ->where('status', true) // Categoria ativa
            ->with(['produto' => function($query) {
                $query->where('status', true) // Produto ativo
                ->whereHas('imagens') // Produto com imagens
                ->with(['variacoes' => function($query) {
                    $query->has('imagens'); // Variação com imagens
                }, 'imagens']); // Inclui as imagens do produto
            }, 'produto.variacoes.imagens']) // Inclui as imagens das variações
            ->first();

       // return view('produto-detalhe',['categorias'=> $this->categorias ]);
    }

    public function render()
    {
        $this->produto_detalhe();
        return view('livewire.produto-detalhe',[
            'categorias' => $this->categorias
        ])->extends('layouts.layout');
    }
}
