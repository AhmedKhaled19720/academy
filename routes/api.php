<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Start user routes
Route::get('/alluser', 'API\UserloginController@index');
Route::get('/show/{id}', 'API\UserloginController@show');
Route::post('/delete', 'API\UserloginController@delete');
Route::post('/create', 'API\UserloginController@create');
Route::post('/update', 'API\UserloginController@update');
// End user routes


// start categories routes 
Route::get('/allcategories', 'API\CategoryController@index');
Route::get('/show/{id}', 'API\CategoryController@show');
Route::post('/create', 'API\CategoryController@create');
Route::post('/update', 'API\CategoryController@update');
Route::post('/delete', 'API\CategoryController@delete');
// End categories routes 