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
Route::resource('loans', 'LoansController');

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
Route::group(['prefix' => 'reports', 'middleware' => 'auth'], function () {
    Route::get('index', [
        'as' => 'reports.index',
        'uses' => 'ReportsController@index'
    ]);
    Route::post('loan', [
        'as' => 'reports.loan',
        'uses' => 'ReportsController@postLoan'
    ]);
    Route::get('interest', [
        'as' => 'reports.interest',
        'uses' => 'ReportsController@interest'
    ]);
    Route::post('interest', [
        'as' => 'reports.interest',
        'uses' => 'ReportsController@postInterest'
    ]);
    Route::get('registration', [
        'as' => 'reports.registration',
        'uses' => 'ReportsController@registration'
    ]);
    Route::post('registration', [
        'as' => 'reports.registration',
        'uses' => 'ReportsController@postRegistration'
    ]);
    Route::get('account', [
        'as' => 'reports.account',
        'uses' => 'ReportsController@account'
    ]);
    Route::post('account', [
        'as' => 'reports.account',
        'uses' => 'ReportsController@postAccount'
    ]);

});

//Account routes
Route::group(['prefix' => 'accounts', 'middleware' => 'auth'], function () {
    Route::get('index', [
        'as' => 'accounts.index',
        'uses' => 'AccountsController@index'
    ]);

    Route::get('query/sales/{fixed?}/{date?}/{range?}/', [
        'as' => 'query.sales',
        'uses' => 'AccountsController@queryTransact'
    ]);
    // post transaction
    Route::post('transact/post', [
        'as' => 'accounts.post.transact',
        'uses' => 'AccountsController@postTransaction'
    ]);
    // Get transactions
    Route::get('transacts', [
        'as' => 'accounts.get.transact',
        'uses' => 'AccountsController@getTransactions'
    ]);

    
    
    // //Route for specific date cashbook record
    // Route::get('query/cashbook/{fixed?}/{date?}/{range?}/', [
    //     'as' => 'query.cashbook',
    //     'uses' => 'AccountsController@queryTransact'
    // ]);

    //Route for opening and current balance
    Route::get('get/accloanbal', [
        'as' => 'get.accloanbal',
        'uses' => 'AccountsController@getAccountLoanBalance'
    ]);
    Route::get('get/withdrawstate', [
        'as' => 'get.withdrawstate',
        'uses' => 'AccountsController@getWithdrawalState'
    ]);
    Route::get('get/loanwithdrawstate', [
        'as' => 'get.loanwithdrawstate',
        'uses' => 'AccountsController@getLoanWithdrawalState'
    ]);
    Route::get('get/loanstate', [
        'as' => 'get.loanstate',
        'uses' => 'AccountsController@getLoanState'
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

    //loans Status
    //Clients accounts
    Route::get('loans', [
        'as' => 'accounts.loans',
        'uses' => 'AccountsController@loanstatus'
    ]);
    Route::get('loans/{loanid}', [
        'as' => 'accounts.loan.details',
        'uses' => 'AccountsController@loanStatusDetails'
    ]);
     Route::get('loan/{action}/{loanid}', [
        'as' => 'accounts.loan.action',
        'uses' => 'AccountsController@loanAction'
    ]);




    //API Route
    Route::get('loaninfo','LoansController@loanInfo');

});
