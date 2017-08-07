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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/contractors', 'ContractorsController@index')->name('contractors');
Route::get('/contractors/create', 'ContractorsController@create')->name('contractors_add');
Route::get('/contractors/edit/{id}', 'ContractorsController@edit')->name('contractors_edit');
Route::post('/contractors/edit/{id}', 'ContractorsController@update')->name('contractors_update');
Route::get('/contractors/details/{id}', 'ContractorsController@show')->name('contractors_details');
Route::post('/contractors/store', 'ContractorsController@store')->name('contractors_store');

Route::get('/employees', 'EmployeesController@show')->name('employees');

Route::get('/tasks', 'TasksController@show')->name('tasks');



Auth::routes();

//Route::get('/', ['middleware' => 'auth:web', 'uses' => 'Auth\AuthController@showLoginForm']);
//Route::post('login', 'Auth\AuthController@login');
//Route::post('logout', 'Auth\AuthController@logout');

