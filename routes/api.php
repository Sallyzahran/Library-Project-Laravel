<?php

use App\Http\Controllers\Api\bookController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthorController;


use App\Http\Controllers\Api\CategoryController;



// use App\Http\Controllers\Api\CategryController;
// use App\Http\Controllers\Api\Auth\RegisterController;
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




// Route::group(['prefix' => 'books', 'middleware' => ['auth:sanctum', 'role:Super admin,Admin']], function () {   
//     Route::get('/', [bookController::class, 'index']);
//     Route::get('/', [bookController::class, 'filter']);
//     Route::get('/{book}', [bookController::class, 'show']);
//     Route::post('/', [bookController::class, 'store']);
//     Route::delete('/{book}', [bookController::class, 'destroy']);
//     Route::put('/{book}', [bookController::class, 'update']);
// });




// Route::group(['prefix' => 'books', 'middleware' => ['auth:sanctum', 'role:Super admin,Admin,Viewer']], function () {
//     Route::get('/{book}', [bookController::class, 'show']);
//     Route::get('/', [bookController::class, 'index']);
//     Route::get('/', [bookController::class, 'filter']);
// });


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

// Route::middleware(['auth:sanctum', 'role:Super admin,Admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
// });

// Route::middleware(['auth:sanctum', 'role:Super admin,Admin,Viewer'])->group(function () {
    Route::resource('categories', CategoryController::class);
// });



Route::group(['prefix' => 'users', 'middleware' => ['auth:sanctum', 'role:Super admin']], function () {

Route::get('/', [UserController::class, 'index']);
Route::get('/{id}', [UserController::class, 'show']);
// Route::post('/', [UserController::class, 'store']);
Route::put('/{id}', [UserController::class, 'update']);
Route::delete('/{id}', [UserController::class, 'destroy']);
Route::patch('/{id}/restore', [UserController::class, 'restore']);
});

Route::post('/users', [UserController::class, 'store']);






// Route::group(['prefix' => 'authors', 'middleware' => ['auth:sanctum', 'role:Super admin,Admin']], function () {


// Route::get('/', [AuthorController::class, 'index']);
// Route::get('/{author}', [AuthorController::class, 'show']);
// Route::post('/', [AuthorController::class, 'store']);
// Route::put('/authors/{author}', [AuthorController::class, 'update']);
// Route::delete('/authors/{author}', [AuthorController::class, 'destroy']);
// Route::patch('/authors/{author}/restore', [AuthorController::class, 'restore']);
// });

// Route::group(['prefix' => 'authors', 'middleware' => ['auth:sanctum', 'role:Super admin,Admin,Viewer']], function () {
//     Route::get('/{author}', [AuthorController::class, 'show']);
//     Route::get('/', [AuthorController::class, 'index']);
// });




// Route::group(['prefix' => 'categories', 'middleware' => ['auth:sanctum', 'role:Super admin,Admin']], function () {
//     Route::get('/', [CategryController::class, 'index']);
//     Route::get('/{category}', [CategryController::class, 'show']);
//     Route::post('/', [CategryController::class, 'store']);
//     Route::delete('/{category}', [CategryController::class, 'destroy']);
//     Route::patch('/{category}/restore', [CategryController::class, 'restore']);
//     Route::put('/{category}', [CategryController::class, 'update']);
// });

// Route::group(['prefix' => 'categories', 'middleware' => ['auth:sanctum', 'role:Super admin,Admin,Viewer']], function () {
//     Route::get('/', [CategryController::class, 'index']);
//     Route::get('/{category}', [CategryController::class, 'show']);
// });











// Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
