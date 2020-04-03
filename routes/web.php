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

#Route::get('/', function(){return "<h2 style='color: red;'>Out of service</h2>";});

Route::get('/', 'MainController@getIndex');

Route::get('login', 'LoginController@getLogin');
Route::post('login', 'LoginController@postLogin');
Route::get('register', 'LoginController@getRegister');
Route::post('register', 'LoginController@postRegister');
Route::get('logout', 'LoginController@getLogout');

Route::get('products', 'MainController@getProducts');
Route::get('product', 'MainController@getProduct');
Route::get('add-product', 'MainController@getAddProduct');
Route::post('add-product', 'MainController@postAddProduct');
Route::get('edit-product', 'MainController@getEditProduct');
Route::post('edit-product', 'MainController@postEditProduct');

Route::get('categories', 'MainController@getCategories');
Route::get('add-category', 'MainController@getAddCategory');
Route::post('add-category', 'MainController@postAddCategory');
Route::get('edit-category', 'MainController@getEditCategory');
Route::post('edit-category', 'MainController@postEditCategory');

Route::get('ads', 'MainController@getAds');
Route::get('new-ad', 'MainController@getAddAd');
Route::post('new-ad', 'MainController@postAddAd');
Route::get('edit-ad', 'MainController@getEditAd');
Route::post('edit-ad', 'MainController@postEditAd');