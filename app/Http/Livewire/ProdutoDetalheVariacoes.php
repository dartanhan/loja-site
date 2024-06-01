<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Traits\CartTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ProdutoDetalheVariacoes extends Component
{
    use CartTrait;

    protected $listeners = ['addCart'];

    public $produtoDetalheVariacoes;
    public $request;
    public $categoriaId;
    public $produtoId;

    public function mount(Request $request){
        $this->request = $request->all();
        
    }

    /***
     * Recebe o ID da categoria PAI (loja_categoria)
          * @return \Illuminate\Http\RedirectResponse
     */
    public function produto_detalhe_variacoes(){

        $validator = Validator::make($this->request, [
            'categoria_id' => 'required|integer',
            'produto_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->route('index');
        } else {

            $this->categoriaId = $this->request['categoria_id'];
            $this->produtoId = $this->request['produto_id'];

            $this->produtoDetalheVariacoes = Categoria::Join('loja_produtos_new', 'loja_categorias.id', '=', 'loja_produtos_new.categoria_id')
                ->Join('loja_produtos_variacao', 'loja_produtos_new.id', '=', 'loja_produtos_variacao.products_id')
                ->rightJoin('loja_produtos_imagens', 'loja_produtos_variacao.id', '=', 'loja_produtos_imagens.produto_variacao_id')
                ->select(
                    'loja_produtos_new.id as produto_id',
                    'loja_categorias.id as categoria_id',
                    'loja_categorias.nome as nome_categoria',
                    'loja_produtos_variacao.id as variacao_id',
                    'loja_produtos_new.descricao as descricao',
                    'loja_produtos_variacao.variacao as variacao',
                    'loja_produtos_variacao.quantidade as quantidade',
                    (DB::raw("loja_produtos_variacao.valor_varejo as valor_varejo")),
                    (DB::raw("loja_produtos_variacao.valor_atacado_10un as valor_atacado")),
                    //(DB::raw("loja_produtos_variacao.valor_atacado_5un as valor_atacado_5un")),
                    //(DB::raw("loja_produtos_variacao.valor_atacado_10un as valor_atacado_10un")),
                    'loja_produtos_imagens.path as path'
                )
                ->where(
                    [
                        'categoria_id' => $this->categoriaId,
                        'loja_produtos_new.id' => $this->produtoId,
                        'loja_categorias.status' => true,
                        'loja_produtos_new.status' => true,
                        'loja_produtos_variacao.status' => true])
                ->where('loja_produtos_variacao.quantidade', '>', 0)
                ->get();
        }
    }

    /***
     * Adiciona os produtos ao carrinho
    */
    public function addCart(int $variacao_id, int $produto_id, $valor_varejo, $valor_atacado,int $quantityTotal, int $quantidade){

        if(Auth::check()){
            $data = [
                'variacao_id' => $variacao_id,
                'produto_id' => $produto_id,
                'valor_varejo' => $valor_varejo,
                'valor_atacado' => $valor_atacado,
                'quantidade' => $quantidade,
                'quantityTotal'=>$quantityTotal
            ];


            $response = $this->addCartTrait($data);

            $this->emit('mensagem', ['titulo' =>$response['message'],'icon' => $response['icon']]);
            // atualiza a quantidade no carrinho
            $this->emit('checkCartCount');

        }else{
            return redirect('../login');// Redireciona para a rota de login
        }
    }

    public function render()
    {
        $this->produto_detalhe_variacoes();
        return view('livewire.produto-detalhe-variacoes',[
            'produtoDetalheVariacoes' => $this->produtoDetalheVariacoes
        ])->extends('layouts.layout');
    }
}
