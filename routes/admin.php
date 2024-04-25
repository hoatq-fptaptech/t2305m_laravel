<?php
use \App\Http\Controllers\AdminController;
Route::get("/",[AdminController::class,"dashboard"]);
Route::get("/orders",[AdminController::class,"orders"]);
Route::get("/orders/{order}",[AdminController::class,"detailOrder"]);
Route::get("/orders/confirm/{order}",[AdminController::class,"confirmOrder"]);

Route::get("/products",[AdminController::class,"products"]);
Route::get("/products/create",[AdminController::class,"productCreate"]);
Route::post("/products/create",[AdminController::class,"productSave"]);
Route::delete("/products/delete/{product}",[AdminController::class,"productDelete"]);
