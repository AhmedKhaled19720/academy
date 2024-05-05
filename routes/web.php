<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
// Auth::routes(['register' => false]);
Route::get('/{page}', 'AdminController@index');

// our routes
Route::get('/showallcategories', 'CategoriesController@index')->name('showallcategories');


Route::get('/categories/show/{id}', 'CategoriesController@show')->name('categories.show');
Route::get('/categories/delete/{id}', 'CategoriesController@delete')->name('categories.delete');

Route::get('/categories/create', 'CategoriesController@create')->name('categories.create');
Route::post('/categories/store', 'CategoriesController@store')->name('categories.store');

Route::get('/categories/edit/{id}', 'CategoriesController@edit')->name('categories.edit');
Route::post('/categories/save', 'CategoriesController@save')->name('categories.save');



// Setinstructors
Route::get('/setinstructor/create', 'SetinstructorsController@create')->name('setinstructors.create');
Route::post('/setinstructor/store', 'SetinstructorsController@store')->name('setinstructors.store');
