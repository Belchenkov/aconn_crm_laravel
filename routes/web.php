<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Auth::routes();


Route::get('/', 'HomeController@index')->name('home');

// Контрагенты
Route::group(['prefix'=>'contractors','middleware'=>'auth'], function () {
    Route::get('/', 'ContractorsController@index')->name('contractors');
    Route::get('/contractorsGetAjax', 'ContractorsController@contractorsGetAjax')->name('contractors_contractorsGetAjax');
    Route::get('/create', 'ContractorsController@create')->name('contractors_add');
    Route::get('/edit/{id}', 'ContractorsController@edit')->name('contractors_edit');
    Route::post('/edit/{id}', 'ContractorsController@update')->name('contractors_update');
    Route::get('/details/{id}', 'ContractorsController@show')->name('contractors_details');
    Route::post('/store', 'ContractorsController@store')->name('contractors_store');
    Route::post('/delete/{id}', 'ContractorsController@destroy')->name('contractors_delete');
    Route::get('/contractorsGetCurrentUser', 'ContractorsController@contractorsGetCurrentUser')->name('contractors_contractorsGetCurrentUser');
    Route::get('/checkRepeat', 'ContractorsController@checkRepeat')->name('contractors_checkRepeat');
});

// Комментарии
Route::group(['prefix'=>'comments','middleware'=>'auth'], function () {
    Route::get('/', 'CommentsController@index')->name('comments');
    Route::post('/add', 'CommentsController@store')->name('comments_add');
});

// Сотрудники
Route::group(['prefix'=>'employees','middleware'=>'auth'], function () {
    Route::get('/', 'EmployeesController@index')->name('employees');
    Route::get('/create', 'EmployeesController@create')->name('employees_create');
    Route::post('/store', 'EmployeesController@store')->name('employees_store');
    Route::get('/edit/{id}', 'EmployeesController@edit')->name('employees_edit');
    Route::post('/edit/{id}', 'EmployeesController@update')->name('employees_update');
});

// Настройки
Route::group(['prefix'=>'settings','middleware'=>'auth'], function () {
    Route::get('/', 'SettingsController@index')->name('settings');
    Route::post('/change-pass', 'SettingsController@changePass')->name('change-pass');

    // Регионы
    Route::group(['prefix'=>'regions','middleware'=>'auth'], function () {
        Route::get('/', 'RegionsController@index')->name('regions');
        Route::post('/create', 'RegionsController@store')->name('regions_create');
        Route::post('/edit/{id}', 'RegionsController@update')->name('regions_update');
        Route::get('/edit/{id}', 'RegionsController@edit')->name('regions_edit');
        Route::post('/delete/{id}', 'RegionsController@destroy')->name('regions_delete');
    });

    // На чем работают
    Route::group(['prefix'=>'what-works','middleware'=>'auth'], function () {
        Route::get('/', 'WhatWorksController@index')->name('what-works');
        Route::post('/create', 'WhatWorksController@store')->name('what-works_store');
        Route::get('/edit/{id}', 'WhatWorksController@edit')->name('what-works_edit');
        Route::post('/edit/{id}', 'WhatWorksController@update')->name('what-works_update');
        Route::post('/delete/{id}', 'WhatWorksController@destroy')->name('what-works_destroy');
    });

    // Периодичность
    Route::group(['prefix'=>'periodicity','middleware'=>'auth'], function () {
        Route::get('/', 'PeriodicityController@index')->name('periodicity');
        Route::post('/create', 'PeriodicityController@store')->name('periodicity_store');
        Route::get('/edit/{id}', 'PeriodicityController@edit')->name('periodicity_edit');
        Route::post('/edit/{id}', 'PeriodicityController@update')->name('periodicity_update');
        Route::post('/delete/{id}', 'PeriodicityController@destroy')->name('periodicity_destroy');
    });

    // Упаковки
    Route::group(['prefix'=>'packings','middleware'=>'auth'], function () {
        Route::get('/', 'PackingsController@index')->name('packings');
        Route::post('/create', 'PackingsController@store')->name('packings_store');
        Route::get('/edit/{id}', 'PackingsController@edit')->name('packings_edit');
        Route::post('/edit/{id}', 'PackingsController@update')->name('packings_update');
        Route::post('/delete/{id}', 'PackingsController@destroy')->name('packings_delete');
    });
});

// Маршруты аутентификации
Route::get('auth/login', 'Auth\AuthController@getLogin')->name('auth_getlogin');




