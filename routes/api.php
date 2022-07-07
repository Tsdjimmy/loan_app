<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::get('/signup', [\App\Http\Controllers\UserController::class, 'signup']);
    Route::post('/login', [\App\Http\Controllers\UserController::class, 'login']);
    Route::group(['middleware' => ['auth:api'], 'prefix' => 'loans'], function () {
        Route::post('/create-loan', [\App\Http\Controllers\LoanController::class, 'createLoan']);
        Route::put('/approve-loan', [\App\Http\Controllers\LoanController::class, 'approveLoan']);
        Route::get('/get-loan', [\App\Http\Controllers\LoanController::class, 'getLoan']);
        Route::get('/all-loans', [\App\Http\Controllers\LoanController::class, 'allLoan']);
    });
    Route::post('/articles/{id}/like', [\App\Http\Controllers\CommentController::class, 'likes']);
    Route::post('/articles/{id}/comment', [\App\Http\Controllers\CommentController::class, 'createComment']);
    Route::get('/articles/{id}/view', [\App\Http\Controllers\ArticleController::class, 'Logview']);