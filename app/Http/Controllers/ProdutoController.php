<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    /***
     * Recebe o ID da categoria PAI (loja_categoria)
     * @param Request $request
     * @return Application|Factory|View
     */
   function produto_detalhe(Request $request){

       $categoriaId = $request->input('categoria_id');

       $categorias = $this->categoria
           ->Join('loja_produtos_new','loja_categorias.id','=' ,'loja_produtos_new.categoria_id')
           ->where(['categoria_id' => $categoriaId, 'loja_categorias.status' => true, 'loja_produtos_new.status' => true])->get();

       return view('produto-detalhe',['categorias'=>$categorias, 'idCategorigoria' => $categoriaId]);
   }

    /***
     * Recebe o ID da categoria PAI (loja_categoria) e o ID do Produto (loja_produtos_new)
     * @param Request $request
     * @return Application|Factory|View | \Illuminate\Http\RedirectResponse
     */
    function produto_detalhe_variacoes(Request $request){

        $validator = Validator::make($request->all(), [
            'categoria_id' => 'required|integer',
            'produto_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->route('index');
        } else {

            $categoriaId = $request->input('categoria_id');
            $produtoId = $request->input('produto_id');

            $produtoDetalheVariacoes = $this->categoria
                ->Join('loja_produtos_new', 'loja_categorias.id', '=', 'loja_produtos_new.categoria_id')
                ->Join('loja_produtos_variacao', 'loja_produtos_new.id', '=', 'loja_produtos_variacao.products_id')
                ->rightJoin('loja_produtos_imagens', 'loja_produtos_variacao.id', '=', 'loja_produtos_imagens.produto_variacao_id')
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
                    ['categoria_id' => $categoriaId,
                        'loja_produtos_new.id' => $produtoId,
                        'loja_categorias.status' => true,
                        'loja_produtos_new.status' => true])->get();

            return view('produto-detalhe-variacoes', ['produtoDetalheVariacoes' => $produtoDetalheVariacoes, 'idCategorigoria' => $categoriaId]);
        }
    }
}
