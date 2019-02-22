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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'diva'], function () {
    // Administrator Routes
    Route::get('/administrator', [
        'uses'  => 'AdminController@index',
        'as'    => 'administrator'
    ]);
    
    // Projects Routes
    Route::get('/projects/all', [
        'uses'  => 'ProjectsController@index',
        'as'    => 'all-projects'
    ]);
    
    Route::get('/projects/add', [
        'uses'  => 'ProjectsController@create',
        'as'    => 'add-new-project'
    ]);

    Route::post('/projects/all', [
        'uses'  => 'ProjectsController@store',
        'as'    => 'store-project'
    ]);

    Route::get('/projects/view/{id}', [
        'uses'  => 'ProjectsController@show',
        'as'    => 'view-project'
    ]);

    Route::get('projects/edit/{id}', [
        'uses'  => 'ProjectsController@edit',
        'as'    => 'edit-project'
    ]);

    Route::post('projects/all/{id}', [
        'uses'  => 'ProjectsController@update',
        'as'    => 'update-project'
    ]);

    Route::get('projects/delete/{id}', [
        'uses'  => 'ProjectsController@destroy',
        'as'    => 'delete-project'
    ]);

    // Feedbacks Routes
    Route::get('feedbacks/all', [
        'uses'  => 'CommonFeedbacksController@index',
        'as'    => 'all-feedbacks'
    ]);

    Route::get('feedbacks/add', [
        'uses'  => 'CommonFeedbacksController@create',
        'as'    => 'add-new-feedback'
    ]);

    Route::post('feedbacks/all', [
        'uses'  => 'CommonFeedbacksController@store',
        'as'    => 'store-feedback'
    ]);

    Route::get('feedbacks/edit/{id}', [
        'uses'  => 'CommonFeedbacksController@edit',
        'as'    => 'edit-feedback'
    ]);

    Route::post('feedbacks/all/{id}', [
        'uses'  => 'CommonFeedbacksController@update',
        'as'    => 'update-feedback'
    ]);

    Route::get('feedbacks/delete/{id}', [
        'uses'  => 'CommonFeedbacksController@destroy',
        'as'    => 'delete-feedback'
    ]);

    // Feedback operations dynamically
    Route::get('feedback/approve/{id}', [
        'uses'  => 'ProjectsController@approveFeedback',
        'as'    => 'approve-feedback'
    ]);

    Route::get('feedback/reject/{id}', [
        'uses'  => 'ProjectsController@rejectFeedback',
        'as'    => 'reject-feedback'
    ]);

    Route::get('feedback/delete/{id}', [
        'uses'  => 'ProjectsController@deleteFeedback',
        'as'    => 'delete-feedback'
    ]);
});
