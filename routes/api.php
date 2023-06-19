<?php

use App\Http\Controllers\bookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::resource('books',bookController::class);


// Route::get('books', [bookController::class,'filter']);


Route::group(['prefix' => 'books'], function () {
    Route::get('/', [bookController::class, 'index']);
    Route::get('/', [bookController::class, 'filter']);
    Route::get('/{book}', [bookController::class, 'show']);
    Route::post('/', [bookController::class, 'store']);
    Route::delete('/{book}', [bookController::class, 'destroy']);
    Route::put('/{book}', [bookController::class, 'update']);
});
