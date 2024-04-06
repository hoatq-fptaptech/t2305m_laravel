<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\WebController;

Route::get('/',[WebController::class,"home"]);
Route::get("/about-us",[WebController::class,"aboutUs"]);

Route::get("/detail/{product:slug}",[WebController::class,'detailProduct']);
Route::get("/detail-cat/{category:slug}",[WebController::class,'detailCategory']);

Route::get("/search",[WebController::class,'search']);

Route::post("/add-to-cart/{product}",[WebController::class,"addToCart"]);
Route::get("/cart",[WebController::class,"cart"]);
Route::get("/checkout",[WebController::class,"checkout"]);
Route::post("/checkout",[WebController::class,"placeOrder"]);
//Route::get("/thank-you/{order}",)
Route::get("/paypal-success/{order}",[WebController::class,"paypalSuccess"]);
Route::get("/paypal-cancel/{order}",[WebController::class,"paypalCancel"]);

//Route::get("/admin")
