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


Route::group(['middleware' => ['auth']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'profiles', 'namespace' => 'Profiles'], function () {

        Route::get('my-profile', 'ProfileController@myProfile')->name('profiles.myProfile');
        Route::put('change-password', 'ProfileController@changePassword')->name('profiles.changePassword');
        Route::put('{id}', 'ProfileController@update')->name('profiles.update');
    });

    Route::group(['prefix' => 'settings', 'namespace' => 'Settings'], function () {

        Route::resource('institution', 'InstitutionController')->except('destroy');
        Route::resource('user', 'UserController');
        Route::put('change-password/{userId}', 'UserController@changePassword')->name('users.changePassword');
        Route::resource('college', 'CollegeController')->except('show');
        Route::resource('department', 'DepartmentController')->except('show');
        Route::resource('program', 'ProgramController')->except('show');
        Route::resource('course', 'CourseController');
        Route::resource('semester', 'SemesterController');

    });

});
Auth::routes();
