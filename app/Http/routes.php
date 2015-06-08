<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');
Route::post('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
Route::get('home/new', 'HomeController@newAd');
Route::post('home/new', 'HomeController@newAdPost');

Route::get('admin', 'AdminController@index');
Route::get('admin/tags', 'AdminController@tags');
Route::post('admin/tags', 'AdminController@tagsPost');
Route::get('admin/users', 'AdminController@users');
Route::post('admin/users', 'AdminController@usersPost');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
