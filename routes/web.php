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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

Route::get('/employee-list', 'EmployeeController@index')->name('employeeList');
Route::get('/employee-list-detail/{id}', 'EmployeeController@show')->name('employeeListDetail');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/employee-add', 'EmployeeController@create')->name('employeeAdd');
    Route::post('/employee-new-add', 'EmployeeController@store')->name('employeeNewAdd');
    Route::get('/employee/{id}/edit', 'EmployeeController@edit')->name('employeeEdit');
    Route::put('/employee/{id}', 'EmployeeController@update')->name('employeeEditNow');
    Route::delete('/employee-destroy/{id}', 'EmployeeController@destroy')->name('employeeDestroy');
});
