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
Route::middleware(['auth'])->group(function () {
    Route::resource('polls', 'PollController');
    Route::get('polls/{poll}/link', 'PollController@link')->name('polls.link');
    Route::resource('polls/{poll}/questions', 'QuestionController');
    Route::resource('polls/{poll}/questions/{question}/answers', 'AnswerController');
    Route::post('polls.include', 'PollController@include')->name('polls.include');
    Route::post('questions.chart', 'QuestionController@chart')->name('questions.chart');
    Route::post('questions.getanswers', 'QuestionController@getAnswers')->name('questions.getanswers');
    Route::post('questions.updateChart', 'QuestionController@updateChart')->name('questions.updateChart');
    Route::get('/polls/{poll}/report1', 'ReportController@report1')->name('polls.report1');
    Route::get('/polls/{poll}/report2/{question}', 'ReportController@report2')->name('polls.report2');
    Route::get('/polls/{poll}/report3/{question}/{answer}', 'ReportController@report3')->name('polls.report3');
    Route::get('/polls/{poll}/generate-pdf', 'ReportController@generatePDF')->name('polls.report.pdf');
    Route::get('/polls/generate-pdf2', 'ReportController@generatePDF2')->name('polls.report.pdf2');
    Route::post('report3.question', 'ReportController@returnAnswers')->name('report3.question');
    Route::post('report3.range', 'ReportController@returnRange')->name('report3.range');
    //Route::get('/polls/{poll}/generate-pdf2/{question}','PollController@test')->name('polls.report.pdf22');
    Route::post('/polls/generate-pdf', 'ReportController@report2Post')->name('polls.questions.post');

});
Route::resource('questionnaire', 'Frontend\PollController')->middleware('checkAnon');

Route::middleware(['moderator'])->group(function () {
    Route::get('/admin/index', 'Admin\AdminController@index')->name('admin.index');
    Route::get('/admin/block', 'Admin\AdminController@block')->name('admin.block');
    Route::get('/admin/polls/{user}', 'Admin\AdminController@polls')->name('admin.polls');
    Route::get('/admin/polls/{poll}/questions/{user}', 'Admin\AdminController@questions')->name('admin.questions');
    Route::get('/admin/polls/{poll}/questions/{question}/answers/{user}', 'Admin\AdminController@answers')->name('admin.answers');
});

Route::get('/agreement', 'Auth\RegisterController@agreement')->name('agreement');
Route::get('/agree', 'Auth\RegisterController@agree')->name('agree');
Route::get('summernoteeditor',array('as'=>'summernoteeditor.get','uses'=>'SummernotefileController@getSummernoteeditor'));



Route::post('/summernoteeditor',array('as'=>'summernoteeditor.post','uses'=>'SummernotefileController@postSummernoteeditor'));
Route::post('/summernote','SummernoteController@store')->name('summernotePersist');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
    // list all lfm routes here...
});