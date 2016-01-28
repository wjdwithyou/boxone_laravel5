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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/cosmos/{name}', function(){
	return view('/cosmos/'.Request::segment(2));
});

Route::get('/', 'MainController@index');

Route::any('{ctr}/{fnc}', Request::segment(1)."Controller@".Request::segment(2));