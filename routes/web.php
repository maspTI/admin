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
Route::resource('departments', 'DepartmentController')->middleware(['auth', 'user.status']);

// Roles Routes
Route::resource('roles', 'RoleController')->middleware(['auth', 'user.status']);

// User Routes
Route::get('/users', 'UserController@index')->name('users.index')->middleware(['auth', 'user.status', 'has.department']);
Route::post('/users', 'UserController@store')->name('users.store')->middleware(['auth', 'user.status', 'has.department']);
Route::get('/users/create', 'UserController@create')->name('users.create')->middleware(['auth', 'user.status', 'has.department']);
Route::match(['PUT', 'PATCH'], '/users/{user}', 'UserController@update')->name('users.update')->middleware(['auth', 'user.status']);
Route::get('/users/departments', 'UserController@editDepartment')->name('users.edit.department')->middleware(['auth', 'user.status']);

// Auth::routes();
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/login/{provider}', 'Auth\SocialLoginController@redirectToProvider')->name('socialite.provider');
Route::get('/auth/{provider}/callback', 'Auth\SocialLoginController@handleProviderCallback')->name('socialite.callback');
