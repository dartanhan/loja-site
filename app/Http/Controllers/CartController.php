<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {

        $cart = session()->get('cart', []);
        //$cartItems = Product::whereIn('id', array_keys($cart))->get();

        return view('cart', compact('cart', 'cartItems'));

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
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $variacaoId = $request->input('variacao_id');
            $productId = $request->input('produto_id');
            $descricao = $request->input('descricao');
            $image = $request->input('path');
            $categoriaId =  $request->input('categoria_id');
            $clienteId =  1;//$request->input('categoria_id');

            $cart = session()->get('cart', []);
            $cart[$productId] = array(
                                        'productId' => $productId ,
                                        'descricao' => $descricao,
                                        'categoriaId' => $categoriaId,
                                        'variacaoId' => $variacaoId,
                                        'clienteId' => $clienteId,
                                        'image' =>$image);
            session()->put('cart', $cart);

            return Response::json(array('success' => true, 'message' => 'Produto adicionado ao carrinho!'), 200);

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
    public function show(cart $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cart  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cart $cr)
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
    public function update(Request $request, cart $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cart  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(cart $cr)
    {
        //
    }
}
