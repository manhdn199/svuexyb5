<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
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

Route::middleware('auth:sanctum')->group(function ()
{
    Route::get('/user',[AuthController::class,'user']);
    Route::get('/logout',[AuthController::class,'logout']);

});
Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);


Route::post('/users',[UserController::class,'index']);
Route::post('/users/store',[UserController::class,'store']);
Route::get('/users/update/{id}', [UserController::class, 'show']);
Route::post('/users/update/{id}', [UserController::class, 'update']);
Route::get('/users/delete/{id}', [UserController::class, 'destroy']);

Route::post('/roles',[RoleController::class,'index']);
Route::post('/roles/store',[RoleController::class,'store']);
Route::get('/roles/update/{id}', [RoleController::class, 'show']);
Route::post('/roles/update/{id}', [RoleController::class, 'update']);
Route::get('/roles/delete/{id}', [RoleController::class, 'destroy']);


