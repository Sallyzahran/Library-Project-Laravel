<?php

use App\Http\Controllers\Api\CategryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
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

Route::get('/categries',[CategryController::class, 'index'])->middleware(['auth:sanctum']);
Route::get('/categries/{categry}',[CategryController::class, 'show']);
Route::post('/categries', [CategryController::class, 'store']);
Route::delete('/categries/{categry}', [CategryController::class, 'destroy']);
Route::patch('/categries/{categry}/restore', [CategryController::class, 'restore']);

Route::put('/categries/{categry}', [CategryController::class, 'update']);

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);