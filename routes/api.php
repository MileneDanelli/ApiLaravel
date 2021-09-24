<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProdutosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Registrar
Route::post('/registrar', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Rotas Protegidas
Route::group(['middleware' => ['auth:sanctum']], function() {
    //Categorias
    Route::resource('/categorias', CategoriasController::class);

    //Produtos
    Route::resource('/produtos', ProdutosController::class);

    //Logout
    Route::post('/sair', [AuthController::class, 'logout']);

    //AutoLogin
    Route::post('/autologin', [AuthController::class, 'autologin']);

    //Retorna usuário
    Route::post('/user', [AuthController::class, 'user']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
