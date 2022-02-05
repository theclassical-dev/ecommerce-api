<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
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

Route::post('/register',[App\Http\Controllers\Authcontroller::class, 'register']);
Route::post('/login',[App\Http\Controllers\Authcontroller::class, 'login']);

Route::get('/details',[App\Http\Controllers\DetailsController::class, 'getAllDetails']);
Route::get('/details/{id}',[App\Http\Controllers\DetailsController::class, 'getDetail']);
Route::get('/details/search/{name}',[App\Http\Controllers\DetailsController::class, 'searchDetail']);
Route::get('/getAllImage', [App\Http\Controllers\UploadController::class, 'getImages']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/details',[App\Http\Controllers\DetailsController::class, 'createDetail']);
    Route::put('/details/update/{id}',[App\Http\Controllers\DetailsController::class, 'updateDetail']);
    Route::delete('/details/delete/{id}',[App\Http\Controllers\DetailsController::class, 'deleteDetail']);
    Route::delete('/details/deleteall',[App\Http\Controllers\DetailsController::class, 'deleteAll']);
    Route::post('/upload', [App\Http\Controllers\UploadController::class, 'upload']);
    Route::delete('/upload/dUpdate/{id}', [App\Http\Controllers\UploadController::class, 'dUpdate']);
    Route::post('/logout',[App\Http\Controllers\Authcontroller::class, 'logout']);
    Route::get('/user/upload', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/user/details', [App\Http\Controllers\UserController::class, 'getDetails']);
});