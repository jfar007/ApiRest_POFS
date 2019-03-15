<?php

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



Route::group(['middleware' => 'guest'], function () {

    Route::get('/', 'Auth\LoginController@showLoginForm');

    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login','Auth\LoginController@login')->name('login');


    // Registration Routes...
    //Student
   /* Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    Route::get('registerSelect', 'Auth\RegisterController@registerSelect')->name('registerSelect');

    //Company
    Route::get('registerCompany', 'Auth\RegisterController@showCompanyRegistrationForm')->name('registerCompany');
    Route::post('registerCompany', 'Auth\RegisterController@registerCompany');

    //Administrator
    Route::get('registerAdmin', 'Auth\RegisterController@showAdminRegistrationForm')->name('registerAdmin');
    Route::post('registerAdmin', 'Auth\RegisterController@registerAdmin');

    Route::get('registerInstitute', 'Auth\RegisterController@showRegisterInstituteForm')->name('registerInstitute');
    Route::post('registerInstitute', 'Auth\RegisterController@registerInstitute');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');*/
});






Route::group(['middleware' => 'auth'], function () {

    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Route from Admin/Controller
    Route::get('dashboard', 'Admin\HomeController@dashboard')->name('dashboard');
    Route::get('productview', 'Admin\ProductViewController@productView')->name('productos');
    Route::get('categoryview', 'Admin\ProductViewController@categoryView')->name('categorias');
    Route::get('unitview', 'Admin\ProductViewController@unitView')->name('unidades');
    Route::get('productsuggestionview', 'Admin\ProductSuggestionViewController@productSuggestionView')->name('sugerenciaProductos');
    Route::get('purchaseorder', 'Admin\OrderViewController@purchaseView')->name('ordenesPedidos');
    Route::get('calendar', 'Admin\OrderViewController@calendarView')->name('calendario');
    Route::get('branchoffice', 'Admin\BranchOfficeControllerView@branchOfficeView')->name('sucursales');
    Route::get('customerview', 'Admin\CustomerViewController@customerView')->name('clientes');
    Route::get('reportsview', 'Admin\ReportsController@reportsViewClient')->name('reportes');

//Access
    Route::get('users', 'Admin\UsersViewController@usersViewClient')->name('usuarios');
    Route::get('rol', 'Admin\UsersViewController@rolViewClient')->name('roles');
    Route::get('profile', 'Admin\UsersViewController@profileViewClient')->name('perfiles');

//Route from Client/Controller
    Route::get('dashboardclient', 'Client\HomeClientViewController@dashboardClientView')->name('dashboardClient');
    Route::get('ordenclient', 'Client\OrderClientView@orderClientView')->name('ordencliente');
    Route::get('lastorderclient', 'Client\OrderClientView@lastOrderClientView')->name('ultimasOrdenes');
    Route::get('statuscurrentorderclient', 'Client\OrderClientView@statusCurrentOrderClientView')->name('estadoOrdenAcutal');
    Route::get('productsuggestionclient', 'Client\OrderClientView@productsuggestionClientView')->name('sugerenciaProductos');
    Route::get('taskclient', 'Client\OrderClientView@taskClientView')->name('programarOrden');

});