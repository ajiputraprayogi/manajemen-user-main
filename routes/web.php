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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login.post');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::group(['middleware' => ['auth','page.admin']], function () {
    Route::get('dashboard','HomeController@index')->name('home');
     //Route Menu
     Route::post('/menu/order', 'MenuController@order');
     Route::resource('/menu', 'MenuController')->only(['index', 'store', 'edit' ,'update', 'destroy']);;
     //Route Role
     Route::get('/role/read', 'RoleController@read')->name('role.read');
     Route::get('/role/select', 'RoleController@select')->name('role.select');
     Route::resource('/role', 'RoleController');
      //Route Role Menu
      Route::post('/rolemenu/update', 'RoleMenuController@update');
});
