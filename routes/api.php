<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Start user routes
Route::get('/allusers', 'API\UserloginController@index');
Route::get('/login', 'API\UserloginController@login');
Route::get('/show/{id}', 'API\UserloginController@show');
Route::post('/delete', 'API\UserloginController@delete');
Route::post('/create', 'API\UserloginController@create');
Route::post('/update', 'API\UserloginController@update');
// End user routes


// start categories routes
Route::get('/allcategories', 'API\CategoryController@index');
Route::get('/show_category/{id}', 'API\CategoryController@show_category');
Route::post('/create_category', 'API\CategoryController@create_category');
Route::post('/update_category', 'API\CategoryController@update_category');
Route::post('/delete_category', 'API\CategoryController@delete_category');
// End categories routes


// start instructors request routes
Route::get('/allinstructors', 'API\InstructorRequestController@index');
Route::post('/create_request', 'API\InstructorRequestController@create_request');
Route::post('/delete_request', 'API\InstructorRequestController@delete_request');
// End instructors request routes


// start instructors routes
Route::get('/view-instructors', 'API\InstructorController@index');
Route::get('/show_instructor/{id}', 'API\InstructorController@show_instructor');
Route::post('/create_instructor', 'API\InstructorController@create_instructor');
Route::post('/update_instructor', 'API\InstructorController@update_instructor');
Route::post('/delete_instructor', 'API\InstructorController@delete_instructor');
// End instructors routes


// start setting routes
Route::get('/home-setting', 'API\SettingController@index');
Route::post('/update_setting', 'API\SettingController@update_setting');
// End setting routes
