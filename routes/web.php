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

// Dashboard Routes
Route::get('/', 'DashboardController@index')->name('dashboard.index')->middleware(['auth', 'user.status', 'has.department']);

// Departments Routes
Route::get('departments', 'DepartmentController@index')->name('departments.index')->middleware(['auth', 'user.status']);
Route::post('departments', 'DepartmentController@store')->name('departments.store')->middleware(['auth', 'user.status', 'has.department']);
Route::get('departments/create', 'DepartmentController@create')->name('departments.create')->middleware(['auth', 'user.status', 'has.department']);
Route::match(['PUT', 'PATCH'], 'departments/{department}', 'DepartmentController@update')->name('departments.update')->middleware(['auth', 'user.status', 'has.department']);
Route::delete('departments/{department}', 'DepartmentController@delete')->name('departments.destroy')->middleware(['auth', 'user.status', 'has.department']);
Route::get('departments/{department}/edit', 'DepartmentController@edit')->name('departments.edit')->middleware(['auth', 'user.status', 'has.department']);

// Roles Routes
Route::get('roles', 'RoleController@index')->name('roles.index')->middleware(['auth', 'user.status']);
Route::post('roles', 'RoleController@store')->name('roles.store')->middleware(['auth', 'user.status', 'has.department']);
Route::get('roles/create', 'RoleController@create')->name('roles.create')->middleware(['auth', 'user.status', 'has.department']);
Route::match(['PUT', 'PATCH'], 'roles/{role}', 'RoleController@update')->name('roles.update')->middleware(['auth', 'user.status', 'has.department']);
Route::delete('roles/{role}', 'RoleController@delete')->name('roles.destroy')->middleware(['auth', 'user.status', 'has.department']);
Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')->middleware(['auth', 'user.status', 'has.department']);

// Subdepartments Routes
Route::get('subdepartments', 'SubdepartmentController@index')->name('subdepartments.index')->middleware(['auth', 'user.status']);
Route::post('subdepartments', 'SubdepartmentController@store')->name('subdepartments.store')->middleware(['auth', 'user.status', 'has.department']);
Route::get('subdepartments/create', 'SubdepartmentController@create')->name('subdepartments.create')->middleware(['auth', 'user.status', 'has.department']);
Route::match(['PUT', 'PATCH'], 'subdepartments/{subdepartment}', 'SubdepartmentController@update')->name('subdepartments.update')->middleware(['auth', 'user.status', 'has.department']);
Route::delete('subdepartments/{subdepartment}', 'SubdepartmentController@delete')->name('subdepartments.destroy')->middleware(['auth', 'user.status', 'has.department']);
Route::get('subdepartments/{subdepartment}/edit', 'SubdepartmentController@edit')->name('subdepartments.edit')->middleware(['auth', 'user.status', 'has.department']);

// User Routes
Route::get('/users', 'UserController@index')->name('users.index')->middleware(['auth', 'user.status', 'has.department']);
Route::post('/users', 'UserController@store')->name('users.store')->middleware(['auth', 'user.status', 'has.department']);
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit')->middleware(['auth', 'user.status', 'has.department']);
Route::get('/users/create', 'UserController@create')->name('users.create')->middleware(['auth', 'user.status', 'has.department']);
Route::match(['PUT', 'PATCH'], '/users/{user}', 'UserController@update')->name('users.update')->middleware(['auth', 'user.status']);
Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy')->middleware(['auth', 'user.status', 'has.department']);
Route::get('/users/departments', 'UserController@editDepartment')->name('users.edit.department')->middleware(['auth', 'user.status']);

// Auth::routes();
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/login/{provider}', 'Auth\SocialLoginController@redirectToProvider')->name('socialite.provider');
Route::get('/auth/{provider}/callback', 'Auth\SocialLoginController@handleProviderCallback')->name('socialite.callback');
