<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use Livewire\Component;

class Category extends Component
{

    public $categorias;

    public function mount(){
        $this->category();
    }

    function category(){
        // Carrega as categorias que têm pelo menos um produto ativo com variações e imagens associadas
        $this->categorias = Categoria::where('status', true) // Categoria ativa
        ->whereHas('produto', function ($query) {
            $query->where('status', true) // Produto ativo
            ->whereHas('variacoes', function ($query) {
                $query->has('imagens');
            });
        })
            ->with(['produto' => function($query) {
                $query->where('status', true) // Produto ativo
                ->whereHas('variacoes', function ($query) {
                    $query->has('imagens');
                });
            }, 'produto.variacoes.imagens'])
            ->get();
    }


    public function render()
    {
        return view('livewire.category',[
            'categorias' => $this->categorias
        ])->extends('layouts.layout');
    }
}
