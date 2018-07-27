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

Route::get('/editprofile','HomeController@edit');
Route::post('/editprofile','HomeController@saveedit');

Route::get('/myorder',function(){
    $tasks = App\Task::where('user_id', '=', Auth::user()->id)
                        ->orderBy('myorder','ASC')
                        ->get();
    $labels = App\Label::getLabels();
    return view('myorder',compact('tasks','labels'));
});

Route::get('/changeorder',function(){
    $tasks = App\Task::where('user_id', '=', Auth::user()->id)
                        ->orderBy('myorder','ASC')
                        ->get();
    return view('changeorder',compact('tasks'));
});
Route::post('/changeorder','HomeController@myorder');

Route::get('/task/create','TaskController@index');
Route::post('/task/create','TaskController@create');

Route::get('/task/{task}','TaskController@showOne');

Route::get('/task/{task}/edit','TaskController@edit');
Route::post('/task/{task}/edit','TaskController@save');

Route::post('/search','TaskController@search');

Route::get('/myday','TaskController@myday');

Route::get('/time','TaskController@time');

Route::get('/pin/{task}','TaskController@pin');

Route::get('/status/{task}','TaskController@status');

Route::get('/archive/{task}','TaskController@archive');

Route::get('/unarchive/{task}','TaskController@unarchive');

Route::get('/archives','TaskController@archivedtasks');

Route::get('/delete/{task}','TaskController@delete');

Route::get('/restore/{task}','TaskController@restore');

Route::get('/deletecompletely/{task}','TaskController@deletecompletely');

Route::post('/remove/{task}/{label}','TaskController@removeLabel');

Route::get('/bin','TaskController@deletedtasks');

Route::get('/{user}/label/create','LabelController@create');
Route::post('/{user}/label/create','LabelController@save');

Route::get('/label/edit','LabelController@edit');
//Route::post('/label/edit','LabelController@save');

Route::get('/labels/{label}','LabelController@show');

Route::post('/add/{label}/to/{task}','LabelController@addLabel');

Route::post('/change/label','LabelController@changeLabel');

Route::post('/delete/label','LabelController@delete');

Route::get('/notifications','HomeController@notify');
Route::post('/notif','HomeController@readnotify');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
