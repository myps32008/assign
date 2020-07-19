<?php

use Illuminate\Support\Facades\Route;

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




Route::get('/login', 'AdminController@show_login')->name('admin.login');
Route::post('/login', 'AdminController@login')->name('admin.check_login');
// dang ky tai khoan
Route::get('/register', 'AdminController@show_register')->name('admin.get_register');
Route::post('/register', 'AdminController@register')->name('admin.register');


Route::group(['middleware' => ['check_auth', 'admin_menu']], function () {
    Route::get('/', function () {
        //return view('welcome');
        return view('layout');
    });
    Route::get('objects/store', 'ObjectController@ajaxStore')->name('objects.storeNew');
    Route::get('objects/updateStatus', 'ObjectController@updateStatus')->name('update.menu.status');
    Route::get('objects/updateShow', 'ObjectController@updateShow')->name('update.menu.show');
    Route::get('objects/updateMenu', 'ObjectController@updateMenu')->name('objects.updateNew');
    Route::get('objects/deleteMenu', 'ObjectController@deleteMenu')->name('objects.deleteNew');
    
    Route::get('roles', 'RoleController@index')->name('role.index');
    Route::get('roles/store', 'RoleController@store')->name('role.store');
    Route::get('roles/destroy', 'RoleController@destroy')->name('role.delete');
    Route::get('roles/edit', 'RoleController@edit')->name('role.edit');
    Route::get('roles/status', 'RoleController@updateStatus')->name('role.update.status');

    Route::get('role_user/user/{id}', 'Role_UserController@index')->name('role_user.index');
    Route::get('role_user/editRole', 'Role_UserController@editAjax')->name('role_user.edit');

    Route::get('role_object/{id}', 'Role_ObjectController@index')->name('role_object.index');

    Route::get('users', 'UserController@index')->name('user.index');
    Route::get('users/status', 'UserController@updateStatus')->name('user.status');
    Route::get('user/delete', 'UserController@destroy')->name('user.delete');
    Route::get('user/edit', 'UserController@edit')->name('user.edit');
    Route::get('/dashboard', 'AdminController@show_dashboard')->name('show_dashboard');
    
    Route::resource('objects', 'ObjectController');
});

Route::get('/logout', 'AdminController@logout')->name('admin.logout');
Route::get('/UnAuthenticate', function () {
    return view('UnAuthenticate');
})->name('unauthenticate');
