<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/login', 'pagesController@login');

Route::get('/', 'pagesController@home');

Route::get('/ventas', 'ventasController@home');

Route::post('/ventas/create', 'ventasController@create');

Route::get('/alertas', 'alertasController@alertas');

Route::post('/alertas', 'alertasController@sendsms');