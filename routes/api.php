<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/u','UserController@store'); //Register
Route::get('/u/verify/{code}','UserController@verify');//From email
Route::post('/u/rp/email','UserController@resetpassword');//Reset password and sent new user password
Route::post('/u/lg','UserController@authenticate'); //Login and reset password, use password_new but new password
Route::get('/u','UserController@index');//Get users
Route::get('/u/{id}','UserController@show');//Get users
Route::post('/u/{id}','UserController@update');//Get users
Route::get('/u/d/{id}','UserController@destroy');//Get users

Route::get('/r','RolController@index');//Get rols
Route::get('/r/{id}','RolController@show');//Get rol

Route::get('/ct','CustomerController@index');//Get Customers
Route::get('/ct/{id}','CustomerController@show');//Get Customer
Route::post('/ct','CustomerController@store');//create Customer
Route::post('/ct/{id}','CustomerController@update');//Update Customer
Route::get('/ct/d/{id}','CustomerController@destroy');//Delete Customer


Route::get('/pf','ProfileController@index');//Get profiles
Route::get('/pf/{id}','ProfileController@show');//Get profile

Route::get('/un','UnitController@index');//Get units
Route::get('/un/{id}','UnitController@show');//Get unit 

Route::get('/cg','CategoryController@index');//Get Categorys
Route::get('/cg/{id}','CategoryController@show');//Get Category 


Route::get('/pt','ProductController@index');//Get Products
Route::get('/pt/{id}','ProductController@show');//Get Product 
Route::post('/pt','ProductController@store');//create Product
Route::post('/pt/{id}','ProductController@update');//Update Product
Route::get('/pt/d/{id}','ProductController@destroy');//Delete Product

Route::get('/lcp','ListCustomerProductController@index');//Get ListCustomerProducts
Route::get('/lcp/{id}','ListCustomerProductController@show');//Get ListCustomerProduct 
Route::post('/lcp','ListCustomerProductController@store');//create ListCustomerProduct
Route::post('/lcp/{id}','ListCustomerProductController@update');//Update ListCustomerProduct
Route::get('/lcp/d/{id}','ListCustomerProductController@destroy');//Delete ListCustomerProduct

