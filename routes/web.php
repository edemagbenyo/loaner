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

//Users routes
Route::resource('users','UsersController');


//Settings Routes
Route::group(['prefix' => 'settings','middleware'=>'auth'], function () {
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

//Settings Routes
Route::group(['prefix' => 'departments','middleware'=>'auth'], function () {

    Route::get('index', [
        'as' => 'departments.index',
        'uses' => 'DepartmentsController@index'
    ]);
    //Rooms Routes
    Route::resource('rooms', 'Departments\RoomsController');
    //View Rooms prices
    Route::get('rooms/view/prices',[
        'as'=>'rooms.view.prices',
        'uses'=>'Departments\RoomsController@viewPrices'
    ]);
    //Set Room price
    Route::get('rooms/set/price/{id}',[
        'as'=>'room.set.price',
        'uses'=>'Departments\RoomsController@setRoomPrice'
    ]);

    //Edit Room Price
    Route::post('rooms/edit/price/{id}',[
        'as'=>'rooms.edit.price',
        'uses'=>'Departments\RoomsController@editRoomPrice'
    ]);

    //Save Room price
    Route::post('rooms/post/price',[
        'as'=>'room.post.price',
        'uses'=>'Departments\RoomsController@postRoomPrice'
    ]);
    //Save Room price
    Route::post('rooms/delete/price/{id}',[
        'as'=>'room.delete.price',
        'uses'=>'Departments\RoomsController@deleteRoomPrice'
    ]);
});
