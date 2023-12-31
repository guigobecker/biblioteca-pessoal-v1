<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LivroController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('livros', [LivroController::class, 'index']);
Route::post('livros', [LivroController::class, 'store']);
Route::get('livros/{id}', [LivroController::class, 'show']);
Route::get('livros/{id}/edit', [LivroController::class, 'edit']);
Route::put('livros/{id}/edit', [LivroController::class, 'update']);
Route::delete('livros/{id}/delete', [LivroController::class, 'destroy']);
