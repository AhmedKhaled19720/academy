<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Start user routes
Route::get('/allusers', 'API\UserloginController@index');
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


// start instructors routes 
Route::get('/allinstructors', 'API\InstructorController@index');
Route::post('/create_request', 'API\InstructorController@create_request');
Route::post('/delete_request', 'API\InstructorController@delete_request');
// End instructors routes 