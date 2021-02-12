<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index') -> name('home');

Route::post('/update/icon', 'HomeController@updateIconUser') -> name('update-icon');

Route::get('/delete/icon', 'HomeController@clearIconUser') -> name('clear-icon');
