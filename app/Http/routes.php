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

/*Route::get('/', 'pagesController@home')->middleware('auth');*/
Route::get('/', 'ventasController@home')->middleware(['auth', 'authNegocio']);

Route::get('/ventas', 'ventasController@home')->middleware(['auth', 'authNegocio']);

Route::post('/ventas/create', 'ventasController@create')->middleware(['auth', 'authNegocio']);

Route::post('/ventas/recarg', 'ventasController@home')->middleware(['auth', 'authNegocio']);

Route::post('/ventas/obtfechVenc', 'ventasController@obtfechVenc')->middleware(['auth', 'authNegocio']);

Route::get('/ventas-list', 'ventasController@listVent')->middleware(['auth', 'authNegocio']);

Route::post('/alert/only', 'alertasController@sendsms')->middleware(['auth', 'authNegocio']);

Route::get('/selectNego', 'pagesController@selectNego')->middleware('auth');

Route::get('/logout/negocioDefect', 'pagesController@negocioDefect')->middleware('auth');

Route::post('/selectNegocio', 'pagesController@selectNegocio')->middleware('auth');

Route::post('/client/create', 'clienteController@create');

Route::get('/clientes', 'clienteController@cliente')->middleware(['auth', 'authNegocio']);

Route::post('/clientes/list', 'clienteController@listClien')->middleware(['auth', 'authNegocio']);

Route::post('/client/createp', 'clienteController@createp');

Route::post('/client/search', 'clienteController@search');

Route::post('/client/searchList', 'clienteController@searchList');

Route::auth();

Route::get('/params-sms', 'negocioController@paramSMS')->middleware(['auth']);
Route::post('/params/smssave', 'negocioController@smsSave')->middleware(['auth']);
