<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\BookController;
use \App\Http\Controllers\Api\UserController;
use \App\Http\Controllers\Api\UserLoanController;
use \App\Http\Controllers\Api\AuthController;
use \App\Http\Controllers\Api\BookTurnoverController;
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
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => ['jwt.verify']], function() {
//        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('get-user', [AuthController::class, 'getUser']);
    });
});


Route::group(['prefix' => 'books'], function () {
//Route::group(['prefix' => 'books', 'middleware' => 'jwt.verify'], function () {
    Route::get('', [BookController::class, 'index']);
    Route::get('/{id}', [BookController::class, 'show']);
    Route::post('', [BookController::class, 'store']);
    Route::patch('/{id}', [BookController::class, 'update']);
    Route::delete('/{id}', [BookController::class, 'destroy']);
});

Route::group(['prefix' => 'users'], function () {
    Route::get('', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('', [UserController::class, 'store']);
    Route::patch('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::group(['prefix' => 'user-loans'], function () {
    Route::get('', [UserLoanController::class, 'index']);
    Route::get('/{id}', [UserLoanController::class, 'show']);
    Route::post('', [UserLoanController::class, 'store']);
    Route::patch('/{id}', [UserLoanController::class, 'update']);
    Route::delete('/{id}', [UserLoanController::class, 'destroy']);
});

Route::group(['prefix' => 'book-turnovers'], function () {
    Route::get('', [BookTurnoverController::class, 'index']);
    Route::get('/{id}', [BookTurnoverController::class, 'show']);
//    Route::post('', [BookTurnoverController::class, 'store']);
//    Route::patch('/{id}', [BookTurnoverController::class, 'update']);
//    Route::delete('/{id}', [BookTurnoverController::class, 'destroy']);
});

