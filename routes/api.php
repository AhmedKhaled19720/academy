<?php

// use App\Http\Controllers\Api\AssignmentController;
use App\Http\Controllers\API\UserloginController;
use App\Http\Controllers\API\AssignmentController;
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


// start Courses routes
Route::get('/allcourses', 'Api\CourseController@index');
Route::get('/show_course/{id}', 'API\CourseController@show_course');
Route::post('/create_course', 'API\CourseController@create_course');
Route::post('/update_course', 'API\CourseController@update_course');
Route::post('/delete_course', 'API\CourseController@delete_course');
// End categories routes


// start contact us routes
Route::get('/contactUs', 'Api\ContactUsController@index');
Route::post('/create_contact', 'API\ContactUsController@create_contact');
Route::post('/delete_contact', 'API\ContactUsController@delete_contact');
// End contact us routes


// start setting routes
Route::get('/home-setting', 'API\SettingController@index');
Route::post('/update_setting', 'API\SettingController@update_setting');
// End setting routes


// start assignments routes
Route::get('/assignments', 'API\AssignmentController@index');
Route::get('/show_assignment/{id}', 'Api\AssignmentController@show_assignment');
Route::post('/create_assignment/{course_id}', [AssignmentController::class, 'create_assignment']);
Route::post('/update_assignments/{course_id}', [AssignmentController::class, 'update_assignments']);
Route::post('/delete_assignment', 'Api\AssignmentController@delete_assignment');
// End assignments routes
