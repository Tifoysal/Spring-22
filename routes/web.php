<?php

use App\Http\Controllers\Backend\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;

Route::get('/', function () {
    return view('backend.pages.dashboard');
});

Route::get('/order', function () {
    return view('backend.pages.order');
});

Route::get('/product',function(){
    return view('backend.pages.product.productList');
});

// url,controller name, controller method,route name
Route::get('/category/form',[CategoryController::class,'categoryForm'])->name('category.form');
Route::post('/category/post',[CategoryController::class,'categoryPost'])->name('category.post');

Route::get('products/list',[ProductController::class,'list'])->name('product.list');
