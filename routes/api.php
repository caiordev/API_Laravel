<?php

use App\Http\Controllers\TarefaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/tarefa',[TarefaController::class, 'store'] );

Route::get('/tarefa',[TarefaController::class, 'index'] );
Route::get('/tarefa/{id}',[TarefaController::class, 'show'] );
Route::put('/tarefa/{id}',[TarefaController::class, 'update'] );
Route::delete('/tarefa/{id}',[TarefaController::class, 'destroy'] );


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
