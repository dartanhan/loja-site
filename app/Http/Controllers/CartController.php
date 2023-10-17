<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {



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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $variacao_id = $request->input('variacao_id');

        return view('cart',compact('variacao_id'));
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
     * @param  \Illuminate\Http\Request  $request
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
