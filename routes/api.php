<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('places', [PlaceController::class, 'index']); // Listar todos os lugares
Route::get('places/filter', [PlaceController::class, 'filterByName']); // Filtrar lugares por nome
Route::get('place', [PlaceController::class, 'show']); // Obter um lugar específico pelo ID
Route::post('place', [PlaceController::class, 'store']); // Criar um novo lugar
Route::put('place/{id}', [PlaceController::class, 'update']); // Atualizar um lugar pelo ID
Route::delete('place/{id}', [PlaceController::class, 'destroy']); // Remover um lugar pelo ID