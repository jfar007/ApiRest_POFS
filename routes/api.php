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

Route::middleware(['jwt.auth'])->group(function(){
   
});
Route::group(['middleware' => ['jwt.auth']], function(){
   
    Route::get('/u/{id}','UserController@show');//Get users
    
});

//Requieren TOKEN
// Route::get('/u/{id}','UserController@show');//Get users
//Route::get('/uapl','UserController@getAuthenticatedUserpl');//Get users
//Route::get('/ua','UserController@getAuthenticatedUser');//Get users
//Route::get('/uainfo','UserController@getAuthenticatedUserInfo');//Get users

//Requieren TOKEN
Route::get('/r','RolController@index');//Get rols
Route::get('/r/{id}','RolController@show');//Get rol


Route::get('/u','UserController@index');//Get users
Route::post('/u','UserController@store'); //Register
Route::get('/u/verify/{code}','UserController@verify');//From email
Route::post('/u/rp/email','UserController@resetpassword');//Reset password and sent new user password
Route::post('/u/lg','UserController@authenticate'); //Login and reset password, use password_new but new password
Route::get('/u','UserController@index');//Get users
// Route::get('/u/{id}','UserController@show');//Get users
Route::post('/u/{id}','UserController@update');//Get users
Route::get('/u/d/{id}','UserController@destroy');//Get users

// Route::get('/r','RolController@index');//Get rols
// Route::get('/r/{id}','RolController@show');//Get rol

Route::get('/ct','CustomerController@index');//Get Customers
Route::get('/ct/{id}','CustomerController@show');//Get Customer
Route::post('/ct','CustomerController@store');//create Customer
Route::post('/ct/{id}','CustomerController@update');//Update Customer
Route::get('/ct/d/{id}','CustomerController@destroy');//Delete Customer

Route::get('/bo','BranchOfficeController@index');//Get BranchOffice
Route::get('/bo/{id}','BranchOfficeController@show');//Get BranchOffice
Route::get('/bo/ct/{id}','BranchOfficeController@showboct');//Get BranchOffice
Route::post('/bo','BranchOfficeController@store');//create BranchOffice
Route::post('/bo/{id}','BranchOfficeController@update');//Update BranchOffice
Route::get('/bo/d/{id}','BranchOfficeController@destroy');//Delete BranchOffice


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


Route::post('/lcpdt','ListCustomerProductDetailsController@store');//Create one ListCustomerProductdetails
Route::post('/lcpdtjson','ListCustomerProductDetailsController@storeJson');//Create and Edit ListCustomerProductdetails 
Route::get('/lcpdt/{list_customer_product_id}','ListCustomerProductDetailsController@show');//Get ListCustomerProductdetails from list_customer_product_id
Route::post('/lcpdt/{id}','ListCustomerProductDetailsController@update');//Edit ListCustomerProductdetails 
Route::get('/lcpdt/d/{id}','ListCustomerProductDetailsController@destroy');//Get ListCustomerProductdetails from list_customer_product_id




Route::get('/om','OrderManagementController@index');//Get OrderManagements
Route::post('/om','OrderManagementController@store');//Create one OrderManagement
Route::post('/om/{id}','OrderManagementController@update');//Update OrderManagement
Route::get('/om/d/{id}','OrderManagementController@destroy');//Delete OrderManagement
Route::get('/om/{id}','ListCustomerProductController@show');//Get OrderManagement 

Route::get('/oma','OrderManagementController@orderManagement');//Get OrderManagements

Route::post('/po','PurchaseOrderDetailsController@store');//Create one PurchaseOrderDetails // Se agrega productos (Sugeridos) a pedido 
Route::get('/po/{id}','PurchaseOrderDetailsController@show');//Get PurchaseOrderDetails
Route::get('/po','PurchaseOrderDetailsController@index');//Get PurchaseOrderDetails

Route::post('/po/{id}','PurchaseOrderDetailsController@editJson');//Post PurchaseOrderDetails

Route::post('/pocst/{id}','PurchaseOrderDetailsController@chageStateSucursalUser');//Update State from SucursalUser
Route::post('/pocst/{id}/{statusId}','PurchaseOrderDetailsController@chageStateDistribuidorUser');//Update State from SucursalUser

Route::post('/popf/{id}','PurchaseOrderDetailsController@index');//Update State from SucursalUser
