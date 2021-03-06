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
Route::get('item/{item}', 'WelcomeController@item');


Route::get('home', 'HomeController@index');
Route::get('home/new', 'HomeController@newAd');
Route::post('home/new', 'HomeController@newAdPost');

Route::any('home/ads', array('as' => 'home/ads', 'uses' => 'HomeController@ads'));
Route::get('home/ads/edit/{id}', 'HomeController@adsEdit');
Route::post('home/ads/edit/{id}', 'HomeController@adsEditPost');
Route::get('home/ads/delete/{id}', 'HomeController@adsDelete');

Route::get('admin', 'AdminController@index');
Route::get('admin/tags', 'AdminController@tags');
Route::post('admin/tags', 'AdminController@tagsPost');
Route::get('admin/users', 'AdminController@users');
Route::post('admin/users', 'AdminController@usersPost');
Route::get('admin/adverts', 'AdminController@adverts');
Route::get('admin/adverts/edit/{id}', 'AdminController@advertsEdit');
Route::post('admin/adverts/edit/{id}', 'AdminController@advertsEditPost');
Route::get('admin/adverts/delete/{id}', 'AdminController@advertsDelete');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);