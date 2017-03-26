<?php

Route::get('/threads/{channel?}', 'ThreadsController@index');
Route::get('/threads/{channel}/{thread}', 'ThreadsController@show');
Route::post('threads', 'ThreadsController@store');
Route::post('threads/{channel}/{thread}/reply', 'ThreadsController@reply');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/{channel?}', 'ThreadsController@index');
