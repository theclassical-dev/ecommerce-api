<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Middleware\VerifyCsrfToken;

use App\Http\Controllers\DetailsController;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;
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
//public functions

Route::group(['prefix' =>'v1/public'], function(){

    //user login & registration page
    Route::post('/register',[App\Http\Controllers\Authcontroller::class, 'register']);
    Route::post('/login',[App\Http\Controllers\Authcontroller::class, 'login']);

    //public access
    Route::get('/get_all_products',[App\Http\Controllers\ProductController::class, 'getAllProduct']);
    Route::get('/get_all_category',[App\Http\Controllers\CategoryController::class, 'get_all_category']);
    //get product review
    Route::get('/get_product_review/{id}',[App\Http\Controllers\ReviewController::class, 'getReview']);
    
});
//admin
Route::group(['prefix' => 'v1/boss'], function () {
    Route::post('/login',[App\Http\Controllers\AdminController::class, 'login']);
    Route::post('/register',[App\Http\Controllers\AdminController::class, 'register']);

});

//cajo
Route::get('/details',[App\Http\Controllers\DetailsController::class, 'getAllDetails']);
Route::get('/details/{id}',[App\Http\Controllers\DetailsController::class, 'getDetail']);
Route::get('/details/search/{name}',[App\Http\Controllers\DetailsController::class, 'searchDetail']);
Route::get('/getAllImage', [App\Http\Controllers\UploadController::class, 'getImages']);

// authenticateed user module
Route::group(['middleware' => ['auth:user'], 'prefix' => 'v1/user'], function () {

    Route::post('/createdetails',[App\Http\Controllers\DetailsController::class, 'createDetail']);
    Route::put('/updatedetails/{id}',[App\Http\Controllers\DetailsController::class, 'updateDetail']);
    // Route::delete('/details/delete/{id}',[App\Http\Controllers\DetailsController::class, 'deleteDetail']);
    // Route::delete('/details/deleteall',[App\Http\Controllers\DetailsController::class, 'deleteAll']);
    Route::post('/upload', [App\Http\Controllers\UploadController::class, 'upload']);
    Route::get('/upload', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/details', [App\Http\Controllers\UserController::class, 'getDetails']);
    Route::delete('/deleteupload/{id}', [App\Http\Controllers\UserController::class, 'dUpload']);
    Route::put('/updateupload/{id}', [App\Http\Controllers\UserController::class, 'updateUpload']);
    
  
    //add cart
    Route::post('/add_to_cart',[App\Http\Controllers\CartController::class, 'add_cart']);
    //update cart
    Route::put('/edit_cart/{id}',[App\Http\Controllers\CartController::class, 'update_cart']);
    //delete cart
    Route::delete('/delete_cart/{id}',[App\Http\Controllers\CartController::class, 'delete_cart']);
    //get added cart by authenticated user
    Route::get('/get_all_cart',[App\Http\Controllers\UserController::class, 'getCart']);
    //add review to product
    Route::post('/add_review',[App\Http\Controllers\ReviewController::class, 'addReview']);
    //delete review
    Route::delete('/delete_review/{id}',[App\Http\Controllers\ReviewController::class, 'deleteReview']);
    //update user record
    Route::post('/edit_record/{id}',[App\Http\Controllers\Authcontroller::class, 'editDetails']);
    //logout
    Route::post('/logout',[App\Http\Controllers\Authcontroller::class, 'logout']);

});

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'v1/admin'], function () {
    //add products
    Route::post('/add_product',[App\Http\Controllers\ProductController::class, 'addProduct']);
    //edit products
    Route::put('/edit_product/{id}',[App\Http\Controllers\ProductController::class, 'updateProduct']);
    //delete products
    Route::delete('/delete_product/{id}',[App\Http\Controllers\ProductController::class, 'deleteProduct']);
    //get all catergory
    Route::get('/get_all_category',[App\Http\Controllers\CategoryController::class, 'get_all_category']);
    //add category
    Route::post('/add_category',[App\Http\Controllers\CategoryController::class, 'addCategory']);
    //update category
    Route::put('/edit_category/{id}',[App\Http\Controllers\CategoryController::class, 'updateCategory']);
    //delete category
    Route::delete('/delete_category/{id}',[App\Http\Controllers\CategoryController::class, 'deleteCategory']);
    //get all users
    Route::get('/get_all_users',[App\Http\Controllers\AdminController::class, 'getUser']);
    //logout
    Route::post('/logout',[App\Http\Controllers\AdminController::class, 'logout']);

});