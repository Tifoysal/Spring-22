<?php

use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;




Route::get('/',[HomeController::class,'home'])->name('home');
Route::post('/customer/registration',[HomeController::class,'customerRegistration'])->name('customer.registration');
Route::get('/product/view/{id}',[HomeController::class,'showProduct'])->name('product.view');
Route::get('/cart/view',[OrderController::class,'viewCart'])->name('cart.view');
Route::get('/cart/add/{id}',[OrderController::class,'addToCart'])->name('cart.add');







//admin routes start here
Route::get('/admin/login',[UserController::class,'login'])->name('admin.login');
Route::post('/admin/do-login',[UserController::class,'doLogin'])->name('admin.do.login');
Route::group(['prefix'=>'admin','middleware'=>'auth'],function (){

    Route::get('/logout',[UserController::class,'logout'])->name('admin.logout');
    Route::get('/', function () {
        return view('backend.pages.dashboard');
    })->name('dashboard');

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

    //customer
    Route::get('/user/list',[UserController::class,'list'])->name('user.list');
});



