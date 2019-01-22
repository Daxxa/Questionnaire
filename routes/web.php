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
Route::resource('polls','PollController');
Route::resource('polls/{id}/questions', 'QuestionController');
/*Route::get('/polls','PollController@index')->name('polls');
Route::get('/polls/create','PollController@create')->name('createPoll');
Route::post('/polls/store','PollController@store')->name('storePoll');
Route::get('/polls/{id}/edit','PollController@edit')->name('editPoll');
Route::put('/polls/{id}/update','PollController@update')->name('updatePoll');
Route::delete('/polls/{id}/destroy','PollController@destroy')->name('destroyPoll');*/