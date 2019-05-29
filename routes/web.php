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
Route::get('/use', 'Controller@use')->name('use');
    Route::resource('polls', 'PollController');
    Route::get('polls/{poll}/link', 'PollController@link')->name('polls.link');
    Route::resource('polls/{poll}/questions', 'QuestionController');
    Route::resource('polls/{poll}/questions/{question}/answers', 'AnswerController');
    Route::post('polls.include', 'PollController@include')->name('polls.include');
Route::resource('questionnaire','Frontend\PollController')->middleware('checkAnon');
Route::post('questions.chart', 'QuestionController@chart')->name('questions.chart');
Route::post('questions.getanswers', 'QuestionController@getAnswers')->name('questions.getanswers');
Route::post('questions.updateChart', 'QuestionController@updateChart')->name('questions.updateChart');
Route::get('/report', 'PollController@report1')->name('polls.report');
