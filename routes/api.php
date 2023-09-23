<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovimentosController;
use App\Http\Controllers\FornecerController;
use App\Http\Controllers\ItensPedidoCompraController;
use App\Http\Controllers\PedidoCompraController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('/register', [UserController::class, 'store']);

Route::post('/login',[AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function(){
Route::apiResources([
    'users' => UserController::class,
    'produtos' => ProdutoController::class,
    'fornecedores' => FornecerController::class,
    'pedido_compras' => PedidoCompraController::class,
    'itens_pedido_compras' => ItensPedidoCompraController::class 
]);
Route::post('/logout',[AuthController::class, 'logout']);
Route::get('/movimentos',[MovimentosController::class, 'getAll']);
});


