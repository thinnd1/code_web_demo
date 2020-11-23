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
    Route::get('/home', 'App\Http\Controllers\AuthController@getInformation')->name('home');
    Route::get('/editinfor', 'App\Http\Controllers\AuthController@viewEditinformation')->name('geteditinfor');
    Route::post('/editinfor', 'App\Http\Controllers\AuthController@updateInformation')->name('editinfor');
    Route::get('/listcustomer', 'App\Http\Controllers\CustomerController@listCustomer')->name('listcustomer');
    Route::get('/delete/{id}', 'App\Http\Controllers\CustomerController@removeCustomer')->name('removecustomer');
    Route::get('/createcustomer', 'App\Http\Controllers\CustomerController@createCustomer')->name('createcustomer');
    Route::get('/editcustomer/{id}', 'App\Http\Controllers\CustomerController@viewEditCustomer')->name('vieweditcustomer');
    Route::post('/editcustomer/{id}', 'App\Http\Controllers\CustomerController@editCustomer')->name('editcustomer');
    Route::get('/viewuserorder/{id}', 'App\Http\Controllers\CustomerController@viewUserOrder')->name('viewuserorder');
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
    Route::post('/updateorder', 'App\Http\Controllers\OrderController@updateOrder')->name('updateorder');
    Route::get('/removeorder', 'App\Http\Controllers\OrderController@deleteOrder')->name('removeorder');

// shop
    Route::get('/shop', 'App\Http\Controllers\ShopController@getShop')->name('shop');
    Route::get('/createshop', 'App\Http\Controllers\ShopController@createShop')->name('createshop');
    Route::get('/deleteshop/{id}', 'App\Http\Controllers\ShopController@deleteShop')->name('deleteshop');

});
