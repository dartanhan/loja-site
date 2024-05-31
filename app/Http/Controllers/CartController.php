<?php

namespace App\Http\Controllers;

use App\Models\ProdutoVariation;
use App\Models\cart;
use App\Models\Pedido;
use App\Models\PedidoProduto;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use App\Traits\CartTrait ;

class CartController extends Controller
{

    use CartTrait;

    public function __construct(Pedido $pedido, ProdutoVariation $produto, PedidoProduto $pedidoProduto)
    {
        $this->pedido        = $pedido;
        $this->produto       = $produto;
        $this->pedidoProduto = $pedidoProduto;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('livewire.cart.index');

    }
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        try {


                $dataForm = $request->all();

                $variacaoId = $dataForm['variacao_id'];
                $productId = $dataForm['produto_id'];
                $descricao = $dataForm['descricao'];
                $image = $dataForm['path'];
                $quantidade =  $dataForm['quantidade'];
                $valor =   $dataForm['valor'];
                $clienteId =  auth()->user()->id;

                //Verifica se tem pedido para o usuário logado
                $pedidoId = $this->pedido->consultaPedido([
                    'user_id' => $clienteId,//$dataForm['user_id'],
                    'status'  => 'RE'
                ]);

                if(empty($pedidoId)):

                    $newPedido = $this->pedido->create([
                        'user_id' =>  $clienteId,//$dataForm['user_id'],
                        'status'  => 'RE'
                    ]);

                    $pedidoId = $newPedido->id;

                endif;

                //Cria o pedido
                $createPedidoProduto =  $this->pedidoProduto->create([
                    'status'        => 'RE',
                    'valor'         =>  $valor,
                    'produto_id'    =>  $variacaoId,
                    'pedido_id'     =>  $pedidoId,
                    'quantidade'     =>  $quantidade
                ]);

                if($createPedidoProduto){
                    return Response::json(array('success' => true, 'message' => 'Produto adicionado ao carrinho!'), 200);
                }



        }catch (\Exception $e){
            return Response::json(array('success' => false,'message' => $e->getMessage()), 401);
        } catch (NotFoundExceptionInterface $e) {
            return Response::json(array('success' => false,'message' => $e->getMessage()), 401);
        } catch (ContainerExceptionInterface $e) {
            return Response::json(array('success' => false,'message' => $e->getMessage()), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cart  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(CartTrait $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cart  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(CartTrait $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\cart  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CartTrait $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cart  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(CartTrait $cr)
    {
        //
    }

    /**
     * Retorna o total de itens do carrinho
     * @param Request $request
     * @return JsonResponse
     */
//    function countCart(Request $request){
//        // Obter o parâmetro de consulta 'userId'
//        $userId = $request->input('userId');
//
//        $pedido = Pedido::with('pedido_produto_item')
//            ->withCount('pedido_produto_item')
//            ->where(['user_id' => $userId,'status' => 'RE'])->get();
//
//        $total = $pedido->isEmpty() ? 0 : $pedido[0]->pedido_produto_item_count;
//
//       // return Response::json(array('success' => true, 'total' => $total), 200);
//    }
}
