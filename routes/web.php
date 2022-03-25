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
Route::get('/category/list',[CategoryController::class,'list'])->name('category.list');
Route::get('/category/form',[CategoryController::class,'categoryForm'])->name('category.form');
Route::post('/category/post',[CategoryController::class,'categoryPost'])->name('category.post');

Route::get('/product/show',[ProductController::class,'product'])->name('admin.product.show');
Route::get('/product/create',[ProductController::class,'productCreate'])->name('product.create');
Route::post('/product/store',[ProductController::class,'productStore'])->name('product.store');
Route::get('/product/edit/{id}',[ProductController::class,'productEdit'])->name('product.edit');
Route::put('/product/update',[ProductController::class,'productUpdate'])->name('product.update');
Route::get('/product/delete/{id}',[ProductController::class,'productDelete'])->name('product.delete');
