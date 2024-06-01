<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Category;
use App\Http\Livewire\ProdutoDetalhe;
use App\Http\Livewire\ProdutoDetalheVariacoes;
use Illuminate\Support\Facades\Auth;

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
Route::get('/', [HomeController::class,'index'])->name('index');

Route::get('/category', Category::class)->name('index');
Route::post('/produto-detalhe',ProdutoDetalhe::class)->name('produto-detalhe');
Route::post('/produto-detalhe-variacoes',ProdutoDetalheVariacoes::class)->name('produto-detalhe-variacoes');

//Route::post('/produto-detalhe',[ProdutoController::class,'produto_detalhe'])->name('produto-detalhe');
//Route::post('/produto-detalhe-variacoes',[ProdutoController::class,'produto_detalhe_variacoes'])->name('produto-detalhe-variacoes');
Route::resource('/produto',ProdutoController::class);



Route::group(['middleware' => 'auth'], function() {
    Route::get('/countCart', [CartController::class, 'countCart'])->name('countCart');
    Route::resource('/cart', CartController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
