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
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@createUser')->name("registrarUsuario");

/*        Route::get('confirmationcode', '')->name('confirmacionCodido');*/


    //Reset Password
       Route::get('password/form', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('formReestablecer');
       Route::post('password/email', 'Auth\ResetPasswordController@resetpassword')->name('reestablecerPassword');



    /*
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

    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');*/
});






Route::group(['middleware' => 'auth'], function () {

    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Route from Admin/Controller
    Route::get('dashboard', 'Admin\HomeController@dashboard')->name('dashboard');
    Route::get('productview', 'Admin\ProductViewController@productView')->name('productos');


    //Route from Categorries
    Route::get('categoryview', 'Admin\ProductViewController@categoryView')->name('categorias');
    Route::get('categoryedit/{id}', 'Admin\ProductViewController@categoryEdit')->name('categoriasEditar');
    Route::post('categorystore' , 'Admin\ProductViewController@categoryStore')->name('categoriasCrear');
    Route::post('categoryupdate/{id}', 'Admin\ProductViewController@categoryUpdate')->name('categoriasModificar');
    Route::get('categorydelete/{id}', 'Admin\ProductViewController@categoryDelete')->name('categoriasEliminar');



    Route::get('unitview', 'Admin\ProductViewController@unitView')->name('unidades');


    //Suggest Product Routes
    Route::get('createproductsuggestionsview', 'Admin\ProductSuggestionViewController@productSuggestionView')->name('crearListaProductos');
    Route::post('productsuggestionsview', 'Admin\ProductSuggestionViewController@saveProductListsCustomerView')->name('guardarListaProductos');

    //Products Suggestions list
    Route::get('listproductsuggestionsview', 'Admin\ProductSuggestionViewController@listProductSuggestions')->name('listaProductoSugeridos');
    Route::get('listproductsuggestionsedit/{id}', 'Admin\ProductSuggestionViewController@ProductListsCustomerViewEdit')->name('listaProductoSugeridosEditar');
    Route::post('listproductsuggestionsuptade', 'Admin\ProductSuggestionViewController@ProductListsCustomerViewUpdate')->name('listaProductoSugeridosActualizar');
    Route::get('listproductsuggestionsdelete/{id}', 'Admin\ProductSuggestionViewController@listProductSuggestionDelete')->name('listaProductoSugeridosEliminar');

    //Details from list-customer-products
    Route::get('listproductsuggestionsdetails/{id}', 'Admin\ProductSuggestionViewController@listProductsSuggestionsDetails')->name('listaProductoSugeridosDetalles');


    //Branch Routes
    Route::get('branchoffice', 'Admin\BranchOfficeControllerView@branchOfficeView')->name('sucursales');
    Route::get('branchofficeedit/{id}', 'Admin\BranchOfficeControllerView@branchOfficeEdit')->name('sucursalEdit');
    Route::post('branchofficestore', 'Admin\BranchOfficeControllerView@branchOfficeStore')->name('sucursalCrear');
    Route::post('branchofficeupdate/{id}', 'Admin\BranchOfficeControllerView@branchOfficeUpdate')->name('sucursalModificar');
    Route::get('branchofficedelete/{id}', 'Admin\BranchOfficeControllerView@branchOfficeDelete')->name('sucursalEliminar');



    Route::get('purchaseorder', 'Admin\OrderViewController@purchaseView')->name('ordenesPedidos');
    Route::get('calendar', 'Admin\OrderViewController@calendarView')->name('calendario');

    //Access to customers
    Route::get('customerview', 'Admin\CustomerViewController@customerView')->name('clientes');
    Route::get('customeredit/{id}', 'Admin\CustomerViewController@customerEdit')->name('clienteEditar');
    Route::post('customerstore', 'Admin\CustomerViewController@customerStore')->name('clienteCrear');
    Route::post('customerupdate/{id}', 'Admin\CustomerViewController@customerUpdate')->name('clienteModificar');
    Route::get('customerdelete/{id}', 'Admin\CustomerViewController@customerDelete')->name('clienteEliminar');


    Route::get('reportsview', 'Admin\ReportsController@reportsViewClient')->name('reportes');


    //Acces Porudcts
    Route::post('productviewstore', 'Admin\ProductViewController@productStore')->name('guardarProducto');
    Route::get('productviewedit/{id}', 'Admin\ProductViewController@productEdit')->name('editarProducto');
    Route::post('productviewupdate/{id}', 'Admin\ProductViewController@update')->name('actualizarProducto');
    Route::get('productviewdelete/{id}', 'Admin\ProductViewController@deleteProduct')->name('eliminarProducto');

//Access
    Route::get('usersview', 'Admin\UsersViewController@usersViewClient')->name('usuarios');
    Route::get('usersedit', 'Admin\UsersViewController@usersEditClient')->name('usuarioEditar');
    Route::get('usersstore', 'Admin\UsersViewController@usersStoreClient')->name('usuarioCrear');
    Route::get('usersupdate', 'Admin\UsersViewController@usersUpdateClient')->name('usuarioActualizar');
    Route::get('usersdelete', 'Admin\UsersViewController@usersDeleteClient')->name('usuarioEliminar');

    //Access
    Route::post('usersstore', 'UserController@userStoreAdmin')->name('usuarioCrearAdmin');
    Route::post('usersupdate', 'UserController@userStoreAdmin')->name('usuarioCrearAdmin');


    //New Password
    Route::post('newPassword','Auth\LoginController@changePassword')->name('cambiarContraseña');

    Route::get('rol', 'Admin\UsersViewController@rolViewClient')->name('roles');
    Route::get('profile', 'Admin\UsersViewController@profileViewClient')->name('perfiles');




//Route from Client/Controller
    Route::get('dashboardclient', 'Client\HomeClientViewController@dashboardClientView')->name('dashboardClient');
    Route::get('ordenclient', 'Client\OrderClientView@orderClientView')->name('ordencliente');
    Route::get('lastorderclient', 'Client\OrderClientView@lastOrderClientView')->name('ultimasOrdenes');
    Route::get('statuscurrentorderclient', 'Client\OrderClientView@statusCurrentOrderClientView')->name('estadoOrdenAcutal');
    Route::get('productsuggestionclient', 'Client\OrderClientView@productsuggestionClientView')->name('sugerenciaProductos');
    Route::get('taskclient', 'Client\OrderClientView@taskClientView')->name('programarOrden');


    Route::get('/pt','ProductController@index')->name('getProducts');//Get Products
    Route::get('/pt/{id}','ProductController@show')->name('obtenerProducto');//Get Product
    Route::post('/pt','ProductController@store')->name('crearProducto');//create Product
    Route::post('/pt/{id}','ProductController@update')->name('modificarProducto');//Update Product
/*    Route::get('/pt/d/{id}','ProductController@destroy')->name('eliminarProducto');//Delete Product*/


});