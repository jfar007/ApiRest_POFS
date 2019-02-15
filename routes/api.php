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

