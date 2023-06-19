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



Route::middleware('auth:sanctum')->prefix('categries')->group(function () {
    Route::get('/', [CategryController::class, 'index']);
    Route::get('/{category}', [CategryController::class, 'show']);
    Route::post('/', [CategryController::class, 'store']);
    Route::delete('/{category}', [CategryController::class, 'destroy']);
    Route::patch('/{category}/restore', [CategryController::class, 'restore']);
    Route::put('/{category}', [CategryController::class, 'update']);
});


Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
