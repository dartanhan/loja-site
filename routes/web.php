<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('index');
});*/
Route::post('/produto-detalhe',[ProdutoController::class,'produto_detalhe'])->name('produto-detalhe');
Route::post('/produto-detalhe-variacoes',[ProdutoController::class,'produto_detalhe_variacoes'])->name('produto-detalhe-variacoes');
Route::resource('/',ProdutoController::class);
Route::resource('/cart',CartController::class);

