<?php

use App\Http\Controllers\Api\bookController;
use App\Http\Controllers\LoginController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthorController;



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




Route::group(['prefix' => 'books', 'middleware' => ['auth:sanctum', 'role:Super admin,Admin']], function () {   
    Route::get('/', [bookController::class, 'index']);
    Route::get('/', [bookController::class, 'filter']);
    Route::get('/{book}', [bookController::class, 'show']);
    // Route::post('/', [bookController::class, 'store']);
    Route::delete('/{book}', [bookController::class, 'destroy']);
    Route::put('/{book}', [bookController::class, 'update']);
});

Route::post('books', [bookController::class, 'store']);



Route::group(['prefix' => 'books', 'middleware' => ['auth:sanctum', 'role:Super admin,Admin']], function () {
    Route::get('/', [bookController::class, 'index']);
    Route::get('/', [bookController::class, 'filter']);
});




Route::post('/login', [LoginController::class, 'login']);


Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::patch('/users/{id}/restore', [UserController::class, 'restore']);

Route::apiResource('authors' ,\App\Http\Controllers\Api\AuthorController::class);





// Route::get('/authors', [\App\Http\Controllers\Api\AuthorController::class, 'index']);
// Route::get('/authors/{id}', [\App\Http\Controllers\Api\AuthorController::class, 'show']);
// Route::post('/authors', [\App\Http\Controllers\Api\AuthorController::class, 'store']);
// Route::put('/authors/{id}', [\App\Http\Controllers\Api\AuthorController::class, 'update']);
// Route::delete('/authors/{id}', [\App\Http\Controllers\Api\AuthorController::class, 'destroy']);
// Route::patch('/authors/{id}/restore', [\App\Http\Controllers\Api\AuthorController::class, 'restore']);