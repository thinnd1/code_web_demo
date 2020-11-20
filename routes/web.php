<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckLogin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//login register
Route::get('/register','App\Http\Controllers\AuthController@viewSignup')->name('viewregister');
Route::get('/getdata','App\Http\Controllers\AuthController@getdata');
Route::post('/register', 'App\Http\Controllers\AuthController@signup')->name('register');
Route::get('/login','App\Http\Controllers\AuthController@viewLogin')->name('viewlogin');
Route::post('/login','App\Http\Controllers\AuthController@login')->name('login');
Route::get('/logout','App\Http\Controllers\AuthController@logout')->name('logout');

Route::middleware(['checklogin::class'])->prefix('admin')->group(function(){
    Route::get('/home', 'App\Http\Controllers\UserController@getInformation')->name('home');
    Route::get('/editinfor', 'App\Http\Controllers\UserController@viewEditinformation')->name('geteditinfor');
    Route::post('/editinfor', 'App\Http\Controllers\UserController@updateInformation')->name('editinfor');
    Route::get('/listcustomer', 'App\Http\Controllers\UserController@listCustomer')->name('listcustomer');
    Route::get('/delete/{id}', 'App\Http\Controllers\UserController@removeCustomer')->name('removecustomer');
    Route::get('/editcustomer/{id}', 'App\Http\Controllers\UserController@viewEditCustomer')->name('vieweditcustomer');
    Route::post('/editcustomer/{id}', 'App\Http\Controllers\UserController@editCustomer')->name('editcustomer');
//product
    Route::get('/product', 'App\Http\Controllers\ProductController@getProduct')->name('product');
//Route::get('/createproduct', 'App\Http\Controllers\ProductController@createProduct')->name('createproduct');
    Route::get('/createproduct', 'App\Http\Controllers\ProductController@viewCreateProduct')->name('viewcreateproduct');
    Route::post('/createproduct', 'App\Http\Controllers\ProductController@createProduct')->name('createproduct');
    Route::get('/vieweditproduct/{id}', 'App\Http\Controllers\ProductController@viewEditproduct')->name('vieweditproduct');
    Route::post('/vieweditproduct/{id}', 'App\Http\Controllers\ProductController@editProduct')->name('editproduct');
    Route::get('/deleteproduct/{id}', 'App\Http\Controllers\ProductController@deleteProduct')->name('deleteproduct');

// order
    Route::get('/order', 'App\Http\Controllers\OrderController@index')->name('order');
    Route::get('/createorder', 'App\Http\Controllers\OrderController@createOrder')->name('createorder');

// shop
    Route::get('/shop', 'App\Http\Controllers\ShopController@getShop')->name('shop');
    Route::get('/createshop', 'App\Http\Controllers\ShopController@createShop')->name('createshop');
    Route::get('/deleteshop/{id}', 'App\Http\Controllers\ShopController@deleteShop')->name('deleteshop');

});
