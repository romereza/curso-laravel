<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('client', 'ClientController@index');
Route::post('client', 'ClientController@store');
Route::get('client/{id}', 'ClientController@show');
Route::delete('client/{id}', 'ClientController@destroy');
Route::put('client/{id}', 'ClientController@update');

Route::get('project/{id}/note', 'ProjectNotesController@index');
Route::post('project/{id}/note', 'ProjectNotesController@store');
Route::get('project/{id}/note/{noteId}', 'ProjectNotesController@show');
Route::delete('project/note/{id}', 'ProjectNotesController@destroy');
Route::put('project/note/{id}', 'ProjectNotesController@update');

Route::get('project/{id}/task', 'ProjectTasksController@index');
Route::post('project/{id}/task', 'ProjectTasksController@store');
Route::get('project/{id}/task/{taskId}', 'ProjectTasksController@show');
Route::delete('project/task/{id}', 'ProjectTasksController@destroy');
Route::put('project/task/{id}', 'ProjectTasksController@update');

Route::get('project/{id}/members', 'ProjectMembersController@index');
Route::get('project/{id}/member/{member_id}', 'ProjectController@isMember');
Route::post('project/{id}/member/{member_id}', 'ProjectController@addMember');
Route::delete('project/{id}/member/{member_id}', 'ProjectController@removeMember');

Route::get('project', 'ProjectController@index');
Route::post('project', 'ProjectController@store');
Route::get('project/{id}', 'ProjectController@show');
Route::delete('project/{id}', 'ProjectController@destroy');
Route::put('project/{id}', 'ProjectController@update');