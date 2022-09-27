<?php

use App\Http\Controllers\Api\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Auth Api's
Route::post('/auth/register', [AuthController::class , 'createUser']);
Route::post('/auth/login', [AuthController::class , 'loginUser']);

//User Api's
Route::put('/updateUser/{id}', [UserController::class , 'update']);
Route::delete('/deleteUser/{id}', [UserController::class , 'destroy']);