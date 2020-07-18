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
    Route::get('objects/updateStatus', 'ObjectController@updateStatus')->name('update.menu.status');
    Route::get('objects/updateShow', 'ObjectController@updateShow')->name('update.menu.show');
    Route::resource('objects', 'ObjectController');
    Route::get('/dashboard', 'AdminController@show_dashboard')->name('show_dashboard');    
});
Route::group(['middleware' => 'admin_menu'], function () {
});
Route::get('/logout', 'AdminController@logout')->name('admin.logout');
Route::get('/UnAuthenticate', function () {
    return view('UnAuthenticate');
})->name('unauthenticate');
