<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProdutosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Categorias
Route::resource('/categorias', CategoriasController::class);


//Produtos
Route::resource('/produtos', ProdutosController::class);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
