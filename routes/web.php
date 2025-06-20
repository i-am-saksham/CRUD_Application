<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products',[ProductController::class,'index'])->name('products.index');
Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
// when submit button hit from create page then route to this route
Route::post('/products',[ProductController::class,'store'])->name('products.store');
// display the edit form
Route::get('/products/{product}/edit',[ProductController::class,'edit'])->name('products.edit');
// {product}:- for product ID.
Route::put('/products/{product}',[ProductController::class,'update'])->name('products.update');
Route::delete('/products/{product}',[ProductController::class,'destroy'])->name('products.delete');
