<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Auth::routes();


Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix'=>'contractors','middleware'=>'auth'], function() {
    Route::get('/', 'ContractorsController@index')->name('contractors');
    Route::get('/create', 'ContractorsController@create')->name('contractors_add');
    Route::get('/edit/{id}', 'ContractorsController@edit')->name('contractors_edit');
    Route::post('/edit/{id}', 'ContractorsController@update')->name('contractors_update');
    Route::get('/details/{id}', 'ContractorsController@show')->name('contractors_details');
    Route::post('/store', 'ContractorsController@store')->name('contractors_store');
    Route::post('/delete/{id}', 'ContractorsController@destroy')->name('contractors_delete');
});

Route::group(['prefix'=>'employees','middleware'=>'auth'], function() {
    Route::get('/', 'EmployeesController@show')->name('employees');
});

Route::group(['prefix'=>'tasks','middleware'=>'auth'], function() {
    Route::get('/', 'TasksController@show')->name('tasks');
});

Route::group(['prefix'=>'settings','middleware'=>'auth'], function() {
    Route::get('/', 'SettingsController@index')->name('settings');
    Route::get('/admin-panel', 'SettingsController@adminPanel')->name('settings_adminPanel');

    Route::group(['prefix'=>'regions','middleware'=>'auth'], function() {
        Route::get('/create', 'RegionsController@create')->name('regions_create');
        Route::get('/edit/{id}', 'RegionsController@edit')->name('regions_edit');
    });

    Route::group(['prefix'=>'what-works','middleware'=>'auth'], function() {
        Route::get('/create', 'WhatWorksController@create')->name('what-works_create');
        Route::get('/edit/{id}', 'WhatWorksController@edit')->name('what-works_edit');
    });

    Route::group(['prefix'=>'periodicity','middleware'=>'auth'], function() {
        Route::get('/create', 'PeriodicityController@create')->name('periodicity_create');
        Route::get('/edit/{id}', 'PeriodicityController@edit')->name('periodicity_edit');
    });

    Route::group(['prefix'=>'packings','middleware'=>'auth'], function() {
        Route::get('/create', 'PackingsController@create')->name('packings_create');
        Route::get('/edit/{id}', 'PackingsController@edit')->name('packings_edit');
    });

});





