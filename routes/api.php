<?php

use App\Http\Controllers\UserController;
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

Route::group(['middleware' => ['web']], function () {
    Route::get('/user', [UserController::class, 'get']);
    Route::post('/user', [UserController::class, 'set']);
    Route::post('/guess', [UserController::class, 'guess']);
    Route::patch('/sendguess', [UserController::class, 'sendGuess']);
});