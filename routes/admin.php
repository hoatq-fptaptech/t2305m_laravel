<?php
use \App\Http\Controllers\AdminController;
Route::get("/",[AdminController::class,"dashboard"]);
Route::get("/orders",[AdminController::class,"orders"]);
Route::get("/orders/{order}",[AdminController::class,"detailOrder"]);
Route::get("/orders/confirm/{order}",[AdminController::class,"confirmOrder"]);
