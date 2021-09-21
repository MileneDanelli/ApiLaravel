<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProdutosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/produtos', [ProdutosController::class, 'index']);

//Registrar
Route::post('/registrar', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Rotas Protegidas
Route::group(['middleware' => ['auth:sanctum']], function() {
    //Categorias
    Route::resource('/categorias', CategoriasController::class);
    Route::get('/categorias/search/{name}', [CategoriasController::class, 'search']);

    //Produtos
    Route::put('/produtos/{name}', [ProdutosController::class, 'update']);
    Route::delete('/produtos/{name}', [ProdutosController::class, 'destroy']);
    Route::post('/produtos', [ProdutosController::class, 'store']);
    Route::get('/produtos/search/{name}', [ProdutosController::class, 'search']);

    //Logout
    Route::post('/sair', [AuthController::class, 'logout']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
