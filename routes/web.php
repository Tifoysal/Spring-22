<?php

use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Backend\OrderController as BackendOrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;




Route::get('/',[HomeController::class,'home'])->name('home');
Route::post('/customer/registration',[HomeController::class,'customerRegistration'])->name('customer.registration');
Route::get('/product/view/{id}',[HomeController::class,'showProduct'])->name('product.view');
Route::get('/cart/view',[OrderController::class,'viewCart'])->name('cart.view');
Route::get('/cart/add/{id}',[OrderController::class,'addToCart'])->name('cart.add');
Route::get('/cart/clear',[OrderController::class,'clearCart'])->name('cart.clear');
Route::get('/cart/delete/{id}',[OrderController::class,'deleteCart'])->name('cart.delete');
Route::post('/cart/update/{id}',[OrderController::class,'updateCart'])->name('cart.update');



Route::group(['middleware'=>'auth'],function (){

    Route::get('/logout',[HomeController::class,'logout'])->name('logout');
    Route::get('/checkout',[OrderController::class,'checkout'])->name('checkout');
    Route::post('/order/place',[OrderController::class,'orderPlace'])->name('order.place');

});






//admin routes start here
Route::get('/admin/login',[UserController::class,'login'])->name('admin.login');
Route::post('/admin/do-login',[UserController::class,'doLogin'])->name('admin.do.login');

Route::group(['prefix'=>'admin','middleware'=>'admin'],function (){
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

    Route::get('/order/list',[BackendOrderController::class,'list'])->name('order.list');
    Route::get('/order/view/{id}',[BackendOrderController::class,'view'])->name('order.view');
});



