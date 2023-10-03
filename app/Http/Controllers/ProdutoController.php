<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
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
       $categorias = $this->categoria->all();

       return view('index', compact('categorias'));
   }

   function produto_detalhe(){
       return view('produto-detalhe');
   }
}
