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

    Route::group(['prefix' => 'reports', 'namespace' => 'Reports'], function () {
        Route::get('reports/institution', 'ReportController@institution')->name('report.institution');
        Route::get('reports/students', 'ReportController@student')->name('report');
    });

    Route::get('/','HomeController@index');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/get-rubric', 'HomeController@getRubric');


    Route::group(['prefix' => 'profiles', 'namespace' => 'Profiles'], function () {

        Route::get('my-profile', 'ProfileController@myProfile')->name('profiles.myProfile');
        Route::put('change-password', 'ProfileController@changePassword')->name('profiles.changePassword');
        Route::put('{id}', 'ProfileController@update')->name('profiles.update');
    });


    Route::group(['prefix' => 'settings', 'namespace' => 'Settings'], function () {

        Route::resource('assignment', 'AssignmentController');
        Route::resource('student', 'StudentController');

        Route::get('assignment/publish/{id}', 'AssignmentController@toogle')->name('publish');
        Route::get('assignment/studentEvaluate/{id}/{studentId}', 'AssignmentController@studentEvaluate')->name('assignment.student_evaluate');
        Route::post('assignment/assigmentEvaluations', 'AssignmentController@assigmentEvaluations')->name('assignment.assigment_evaluation');
        Route::get('assignment/evaluate/{id}', 'AssignmentController@evaluate')->name('evaluate');
        Route::get('assignment/analysis/{id}', 'AssignmentController@analysis')->name('analysis');
        Route::post('students/create', 'CourseSectionController@storeStudents')->name('storeStudents');
        Route::post('analysis/create', 'AssignmentController@storeAnalysis')->name('storeAnalysis');
        Route::get('analysis/{id}/edit', 'AssignmentController@editAnalysis')->name('editAnalysis');
        Route::put('analysis/{id}', 'AssignmentController@updateAnalysis')->name('updateAnalysis');

        Route::post('students/delete', 'CourseSectionController@deleteStudents')->name('deleteStudents');

        Route::get('students/{id}', 'CourseSectionController@students')->name('students');

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
