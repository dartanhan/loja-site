<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    protected $request,$produto;

    public function __construct(Request $request, Produto $produto) {

        $this->request = $request;
        $this->produto = $produto;
    }

   function index(){

       $produtos = $this->produto->all();

       return view('index', compact('produtos'));
   }
}
