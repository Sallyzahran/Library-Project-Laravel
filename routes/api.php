<?php

use App\Http\Controllers\Api\bookController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\CategoryController;



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




//User Routes

Route::middleware(['auth:sanctum', 'role:Super admin'])->group(function () {
    Route::resource('users', UserController::class);
});




//Book Routes

Route::middleware(['auth:sanctum', 'role:Super admin,Admin'])->group(function () {
    Route::resource('books', bookController::class);
});

Route::middleware(['auth:sanctum', 'role:Super admin,Admin,Viewer'])->group(function () {
    Route::resource('books', bookController::class)->only(['show','index']);
});



//Author Routes

Route::middleware(['auth:sanctum', 'role:Super admin,Admin'])->group(function () {
    Route::resource('authors', AuthorController::class);
});

Route::middleware(['auth:sanctum', 'role:Super admin,Admin,Viewer'])->group(function () {
    Route::resource('authors', AuthorController::class)->only(['show', 'index']);
});



//Category Routes

Route::middleware(['auth:sanctum', 'role:Super admin,Admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
});

Route::middleware(['auth:sanctum', 'role:Super admin,Admin,Viewer'])->group(function () {
    Route::resource('categories', CategoryController::class)->only(['show','index']);
});






// Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
