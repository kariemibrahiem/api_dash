<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ResetPassword\ForgotPasswordController;
use App\Http\Controllers\Api\ResetPassword\ResetPasswordController;

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



Route::group(["middleware" => ["api" , "auth.check"]], function () {
    Route::apiResource('users', \App\Http\Controllers\Api\UserApiController::class);
    Route::apiResource("attendance" , \App\Http\Controllers\Api\AttendanceController::class);

});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [\App\Http\Controllers\Api\AuthApiController::class, 'login']);
    Route::post('logout', [\App\Http\Controllers\Api\AuthApiController::class, 'logout']);
    Route::post('refresh', [\App\Http\Controllers\Api\AuthApiController::class, 'refresh']);
    Route::post('me', [\App\Http\Controllers\Api\AuthApiController::class, 'me']);
});

