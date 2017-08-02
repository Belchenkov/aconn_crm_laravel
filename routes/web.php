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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contragents', 'ContragentsController@show')->name('contragents');
Route::get('/employees', 'EmployeesController@show')->name('employees');
Route::get('/tasks', 'TasksController@show')->name('tasks');
//
//Route::get('login', 'Auth\AuthController@showLoginForm');
//Route::post('login', 'Auth\AuthController@login');
//Route::post('logout', 'Auth\AuthController@logout');
