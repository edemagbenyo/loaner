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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
//Change user password
Route::get('users/change-password',[
    'as'=>'changepassword',
    'uses'=>'UsersController@changePassword'
]);
Route::put('users/change-password',[
    'as'=>'changepassword',
    'uses'=>'UsersController@updatePassword'
]);
Route::post('users/reset-password',[
    'as'=>'resetpassword',
    'uses'=>'UsersController@resetPassword'
]);
//Users routes
Route::resource('users', 'UsersController');



//Clients routes
Route::resource('clients', 'ClientsController');
Route::get('api/client', [
    'as' => 'api.client',
    'uses' => 'ClientsController@apiClientOne'
]);
//Suppliers routes
Route::resource('suppliers', 'SuppliersController');

//Suppliers routes
Route::resource('lands', 'LandsController');

//Users calls
Route::get('users-calls',[
    'as'=>'userscalls',
    'uses'=>'CallsController@usersCalls'
]);
//User calls
Route::get('user-calls/{userid}',[
    'as'=>'usercalls',
    'uses'=>'CallsController@userCalls'
]);

//Calls routes
Route::resource('calls', 'CallsController');


//Settings Routes
Route::group(['prefix' => 'settings', 'middleware' => 'auth'], function () {
    Route::get('index', [
        'as' => 'settings.index',
        'uses' => 'SettingsController@index'
    ]);

    //List roles and permissions
    Route::get('roles-permissions', [
        'as' => 'roles.perms',
        'uses' => 'SettingsController@getRolesAndPermissions'
    ]);

    //Roles Routes
    Route::resource('roles', 'Settings\RolesController');


    //Permissions Routes
    Route::resource('permissions', 'Settings\PermissionsController');

});

//Account routes
Route::group(['prefix' => 'accounts', 'middleware' => 'auth'], function () {
    Route::get('index', [
        'as' => 'accounts.index',
        'uses' => 'AccountsController@index'
    ]);

    Route::get('query/sales/{fixed?}/{date?}/{range?}/', [
        'as' => 'query.sales',
        'uses' => 'AccountsController@querySales'
    ]);
    // post sales
    Route::post('sales/post', [
        'as' => 'accounts.post.sales',
        'uses' => 'AccountsController@postSales'
    ]);

    //Cashbook
    Route::get('cashbook', [
        'as' => 'accounts.cashbook',
        'uses' => 'AccountsController@cashbook'
    ]);
    Route::post('cashbook/post', [
        'as' => 'accounts.post.cashbook',
        'uses' => 'AccountsController@postCashbook'
    ]);
    //Route for specific date cashbook record
    Route::get('query/cashbook/{fixed?}/{date?}/{range?}/', [
        'as' => 'query.cashbook',
        'uses' => 'AccountsController@queryCashbook'
    ]);

    //Route for opening and current balance
    Route::get('get/openclosebalance', [
        'as' => 'get.openclose',
        'uses' => 'AccountsController@getOpeningClosingBalance'
    ]);



    //Clients accounts
    Route::get('clients', [
        'as' => 'accounts.clients',
        'uses' => 'AccountsController@clients'
    ]);

    Route::get('clients/account/{clientid}',[
        'as'=>'view.client.account',
        'uses'=>'AccountsController@viewClientAccount'
    ]);

    //Clients accounts
    Route::get('suppliers', [
        'as' => 'accounts.suppliers',
        'uses' => 'AccountsController@suppliers'
    ]);

    Route::get('suppliers/account/{supplierid}',[
        'as'=>'view.supplier.account',
        'uses'=>'AccountsController@viewSupplierAccount'
    ]);

    //Lands Status
    //Clients accounts
    Route::get('lands', [
        'as' => 'accounts.lands',
        'uses' => 'AccountsController@landStatus'
    ]);

});


//Settings Routes
Route::group(['prefix' => 'departments', 'middleware' => 'auth'], function () {

    Route::get('index', [
        'as' => 'departments.index',
        'uses' => 'DepartmentsController@index'
    ]);
    //Rooms Routes
    Route::resource('rooms', 'Departments\RoomsController');
    //View Rooms prices
    Route::get('rooms/view/prices', [
        'as' => 'rooms.view.prices',
        'uses' => 'Departments\RoomsController@viewPrices'
    ]);
    //Set Room price
    Route::get('rooms/set/price/{id}', [
        'as' => 'room.set.price',
        'uses' => 'Departments\RoomsController@setRoomPrice'
    ]);

    //Edit Room Price
    Route::post('rooms/edit/price/{id}', [
        'as' => 'rooms.edit.price',
        'uses' => 'Departments\RoomsController@editRoomPrice'
    ]);

    //Save Room price
    Route::post('rooms/post/price', [
        'as' => 'room.post.price',
        'uses' => 'Departments\RoomsController@postRoomPrice'
    ]);
    //Save Room price
    Route::post('rooms/delete/price/{id}', [
        'as' => 'room.delete.price',
        'uses' => 'Departments\RoomsController@deleteRoomPrice'
    ]);
});
