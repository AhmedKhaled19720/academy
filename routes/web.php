<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\EnrollcourseController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\UserloginController;
use App\Model\enrollcourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
// Auth::routes(['register' => false]);

// our routes
Route::get('/home', 'HomeController@index')->name('home');


// start userlogin
Route::post('/toggle-status/{id}', [UserloginController::class, 'toggleStatus'])->name('toggle-status');
Route::get('/allusers', 'UserloginController@index')->name('allusers');
Route::post('/users/save', 'UserloginController@save')->name('users.save');
Route::get('/users/crud/create', 'UserloginController@create')->name('users.create');
Route::delete('/user/delete/{id}', 'UserloginController@delete')->name('user.delete');
Route::resource('users', 'userloginController');
//view assignments of specific user and specific course
Route::get('/courses/{courseId}/students/{studentId}/assignments','UserloginController@showStudentAssignments')
    ->name('student.assignments');


// end user login


// start categories
Route::get('/allcategories', 'CategoryController@index')->name('allcategories');
Route::get('/categories/crud/create', 'CategoryController@create')->name('categories.create');
Route::post('/categories/save', 'CategoryController@save')->name('categories.save');
Route::post('/categories/saveupdate', 'CategoryController@saveupdate')->name('categories.saveupdate');
Route::delete('/categories/delete/{id}', 'CategoryController@delete')->name('categories.delete');
Route::resource('categories', 'CategoryController');
// end categories


// start instructors requests
Route::get('/allinstructors', 'InstructorRequestController@index')->name('allinstructors');
Route::delete('/request/delete/{id}', 'InstructorRequestController@delete')->name('request.delete');

Route::post('/change-role-to-0', 'InstructorRequestController@changeRoleTo0')->name('change.role.to0');
Route::post('/change-role-to-1', 'InstructorRequestController@changeRoleTo1')->name('change.role.to1');



// End instructors requests


// start instructors
Route::get('/view-instructors', 'InstructorController@index')->name('instructors');
Route::get('/instructors/crud/create', 'InstructorController@create')->name('instructors.create');
Route::get('/instructors/crud/show/{id}', 'InstructorController@show')->name('instructors.show');
Route::get('/instructors/crud/edit/{id}', 'InstructorController@edit')->name('instructors.edit');
Route::post('/instructors/save', 'InstructorController@save')->name('instructors.save');
Route::post('/instructors/saveupdate', 'InstructorController@saveupdate')->name('instructors.saveupdate');
Route::delete('/instructors/delete/{id}', 'InstructorController@delete')->name('instructors.delete');
// end categories


// start setting
Route::get('/home-setting', 'SettingController@index')->name('home-setting');
Route::get('/setting/crud/edit/{id}', 'SettingController@edit')->name('setting.edit');
Route::post('/setting/saveupdate', 'SettingController@saveupdate')->name('setting.saveupdate');
// End setting


// start profile
Route::get('/profile-user', 'ProfileController@index')->name('profile-user');
Route::get('/user-profile/crud/edit', 'ProfileController@edit')->name('profile.edit');
Route::post('/user-profile/save', 'ProfileController@save')->name('user-profile.save');
// End profile


// start courses
Route::get('/view-courses', 'CourseController@index')->name('courses');
Route::get('/courses/create', 'CourseController@create')->name('courses.create');
Route::get('courses/{id}/edit', 'CourseController@edit')->name('courses.edit');
Route::put('courses/{id}', 'CourseController@update')->name('courses.update');
Route::get('/courses/crud/show{id}', 'CourseController@show')->name('courses.show');
Route::post('/courses/store', 'CourseController@store')->name('courses.store');
Route::delete('/courses/{id}', 'CourseController@destroy')->name('courses.destroy');

//show all user enrolled a course
Route::get('courses/{id}/students', 'CourseController@showStudents')->name('courses.students');


// end courses


//start assignments

Route::group(['prefix' => 'courses/{course_id}'], function () {
    Route::get('assignments', [AssignmentController::class, 'index'])->name('assignments.index');
    Route::get('assignments/create', [AssignmentController::class, 'create'])->name('assignments.create');
    Route::post('assignments', [AssignmentController::class, 'store'])->name('assignments.store');
});

Route::get('/view-Assignments', 'AssignmentController@index')->name('view-Assignments');
Route::get('/Assignments/create/{id}', 'AssignmentController@create')->name('assignments.create');
Route::get('/Assignments/crud/show{id}', 'AssignmentController@show')->name('assignments.show');
Route::get('/Assignments/crud/show_one{id}', 'AssignmentController@show_one')->name('assignments.show_one');
Route::delete('/Assignments/{id}', 'AssignmentController@destroy')->name('assignments.destroy');
Route::post('assignments/update/{course_id}/{assignment_id}', 'AssignmentController@update')->name('assignments.update');


//end assignments



//Grades


 // Fetch students enrolled in the course and Find the course and Get task degree from assignment table and Get course name andGet assignment name
Route::get('/assignments/{assignment}/students', 'GradeController@showStudents')->name('assignments.students');

Route::post('/grades', 'GradeController@store')->name('grades.store');
// to show all students with grades 
Route::get('/assignments/{assignment}/all-students', 'GradeController@showAllStudentsWithGrades')->name('assignments.all_students');
// to update grade for one student
Route::put('/grades/{grade}','GradeController@update')->name('grades.update');
// to view stu grade
Route::get('/users/{userId}/grades', 'GradeController@showOneStudentGrades')->name('users.grades.show');








//Start Enroll Course

//enroll home page
Route::get('enrollCourse', 'EnrollCourseController@index')->name('enroll.index');
Route::post('enrollCourse/enroll','EnrollCourseController@store')->name('enrollCourse.store');
Route::delete('/enrollCourse/{id}', 'EnrollCourseController@destroy')->name('enrollCourse.destroy');
//active and dis active switch button
Route::post('/toggle-subscription/{id}', 'EnrollcourseController@toggleSubscription')->name('toggle-subscription');

//End Enroll Course





// start contact us
Route::get('/contactUs', 'ContactUsController@index')->name('contactUs');
Route::delete('/contactUs/delete/{id}', 'ContactUsController@delete')->name('contactUs.delete');
Route::post('/change-role-to-0', 'ContactUsController@changeRoleTo0')->name('contactUs.change.role.to0');
Route::post('/change-role-to-1', 'ContactUsController@changeRoleTo1')->name('contactUs.change.role.to1');
// end contact us








Route::options('/api/create', function () {
    return response()->json([], 200)
        ->header('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type');
});
Route::get('/{page}', 'AdminController@index');