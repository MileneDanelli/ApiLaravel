<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProdutosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Categorias
Route::resource('/categorias', CategoriasController::class);
Route::get('/categorias/search/{name}', [CategoriasController::class, 'search']);

//Produtos
Route::resource('/produtos', ProdutosController::class);
Route::get('/produtos/search/{name}', [ProdutosController::class, 'search']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
