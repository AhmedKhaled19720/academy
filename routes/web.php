<?php

use App\Http\Controllers\UserloginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
// Auth::routes(['register' => false]);

// our routes
Route::get('/allcategoriesdata', 'CategoryController@index')->name('alldata');


// start userlogin
Route::get('/alluser', 'UserloginController@index')->name('alluser');
Route::post('/user/save', 'UserloginController@save')->name('user.save');
Route::get('/user/crud/create', 'UserloginController@create')->name('user.create');
Route::delete('/user/delete/{id}', 'UserloginController@delete')->name('user.delete');
Route::resource('user', 'userloginController');
// end user login

// start categories
Route::get('/allcategories', 'CategoryController@index')->name('allcategories');
Route::get('/categories/crud/create', 'CategoryController@create')->name('categories.create');
Route::post('/categories/save', 'CategoryController@save')->name('categories.save');
Route::post('/categories/saveupdate', 'CategoryController@saveupdate')->name('categories.saveupdate');
Route::delete('/categories/delete/{id}', 'CategoryController@delete')->name('categories.delete');
Route::resource('categories', 'CategoryController');


// end categories

Route::get('/{page}', 'AdminController@index');
