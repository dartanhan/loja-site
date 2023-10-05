<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    protected $request,$produto,$categoria;

    public function __construct(Request $request, Produto $produto,Categoria $categoria) {

        $this->request = $request;
        $this->produto = $produto;
        $this->categoria = $categoria;
    }

   function index(){

       //$produtos = $this->produto->all();
       $categorias = $this->categoria->where('status',true)->get();

       return view('index', compact('categorias'));
   }

   function produto_detalhe(int $id){

       $categorias = $this->categoria
           ->Join('loja_produtos_new','loja_categorias.id','=' ,'loja_produtos_new.categoria_id')
           ->where(['categoria_id' => $id, 'loja_categorias.status' => true, 'loja_produtos_new.status' => true])->get();

       return view('produto-detalhe',['categorias'=>$categorias, 'idCategorigoria' => $id]);
   }

    /***
     * Recebe o ID da categoria PAI (loja_categoria) e o ID do Produto (loja_produtos_new)
     * @param int $idCatPai
     * @param int $id
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    function produto_detalhe_variacoes(int $idCatPai,int $id){

        $produtoDetalheVariacoes = $this->categoria
            ->Join('loja_produtos_new','loja_categorias.id','=' ,'loja_produtos_new.categoria_id')
            ->Join('loja_produtos_variacao','loja_produtos_new.id','=' ,'loja_produtos_variacao.products_id')
            ->rightJoin('loja_produtos_imagens','loja_produtos_variacao.id','=' ,'loja_produtos_imagens.produto_variacao_id')
            ->select(
                'loja_produtos_new.id as produto_id',
                'loja_categorias.id as categoria_id',
                'loja_categorias.nome as nome_categoria',
                'loja_produtos_variacao.id as variacao_id',
                'loja_produtos_new.descricao as descricao',
                'loja_produtos_variacao.variacao as variacao',
                'loja_produtos_imagens.path as path'
            )
            ->where(
                ['categoria_id' => $idCatPai,
                    'loja_produtos_new.id' => $id,
                    'loja_categorias.status' => true,
                    'loja_produtos_new.status' => true])->get();

        return view('produto-detalhe-variacoes',['produtoDetalheVariacoes'=>$produtoDetalheVariacoes, 'idCategorigoria' => $id]);
    }
}
