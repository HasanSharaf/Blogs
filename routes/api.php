<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BlogController;
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


//Auth API's
Route::post('/auth/register', [AuthController::class , 'createUser']);
Route::post('/auth/login', [AuthController::class , 'loginUser']);
Route::get('/logout', [AuthController::class , 'logout'])->middleware('auth:sanctum');

//User API's
Route::put('/updateUser/{id}', [UserController::class , 'update']);
Route::delete('/deleteUser/{id}', [UserController::class , 'destroy']);

//Blog API's
Route::get('/', [BlogController::class, 'index']);
Route::get('/{id}', [BlogController::class, 'show']);
Route::get('/blog/create/post', [BlogController::class, 'create'])->middleware('auth:sanctum');
Route::post('/blog/create/post', [BlogController::class, 'store'])->middleware('auth:sanctum');
Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->middleware('auth:sanctum'); 
Route::put('/blog/{id}/edit', [BlogController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/blog/{id}', [BlogController::class, 'destroy'])->middleware('auth:sanctum');

