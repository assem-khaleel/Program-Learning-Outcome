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

        Route::resource('assignment', 'AssignmentController');
        Route::get('assignment-publish/{assignment_id?}', 'AssignmentController@publish');

        Route::get('assignment/publish/{id}', 'AssignmentController@toogle')->name('publish');

        Route::resource('institution', 'InstitutionController')->except('destroy');
        Route::resource('user', 'UserController');
        Route::put('change-password/{userId}', 'UserController@changePassword')->name('users.changePassword');
        Route::resource('college', 'CollegeController')->except('show');
        Route::resource('department', 'DepartmentController')->except('show');
        Route::resource('program', 'ProgramController')->except('show');
        Route::resource('course', 'CourseController');
        Route::get('course-section/create/{course_section}', 'CourseSectionController@create')->name('course-section.create');
        Route::resource('course-section', 'CourseSectionController')->except('create');
        Route::resource('semester', 'SemesterController')->except('show');

    });

    Route::resource('learning-outcome', 'LearningOutcomeController');
    Route::resource('rubric', 'RubricController')->except('show');
    Route::post('rubric/{rubric}', 'RubricController@storeRubric')->name('rubric.storeRubric');
    Route::get('draw-rubric/{rows}/{columns}/{rubricId}', 'RubricController@drawRubric')->name('rubric.draw');
    Route::post('add-row', 'RubricController@addRow')->name('rubric.row');
    Route::post('add-column', 'RubricController@addColumn')->name('rubric.column');
    Route::post('store-draw-rubric', 'RubricController@storeDrawRubric')->name('rubric.storeDrawRubric');
    Route::put('add-row/{rubric}', 'RubricController@addRowUpdate')->name('rubric.rowUpdate');
    Route::put('add-column/{rubric}', 'RubricController@addColumnUpdate')->name('rubric.columnUpdate');
    Route::put('delete-row/{rubric}', 'RubricController@deleteRow')->name('rubric.deleteRow');
    Route::put('delete-column/{rubric}', 'RubricController@deleteColumn')->name('rubric.deleteColumn');
});
Auth::routes();
