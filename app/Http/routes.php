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
	Route::get('/', function () {
		return view('welcome');
	});

	Route::get('/produtos','ProdutoController@lista');
	
	Route::get(
		'/produtos/mostra/{id}',
		'ProdutoController@mostra'
		)
	->where('id', '[0-9]+');
	
	Route::get('/produtos/novo', 'ProdutoController@novo');
	
	Route::post('/produtos/adiciona', 'ProdutoController@adiciona');
	
	Route::get('/produtos/remove/{id}', 'ProdutoController@remove');

	Route::get('/produtos/edita/{id}', 'ProdutoController@edita');
	
	Route::post('/produtos/altera', 'ProdutoController@altera');
	
	Route::get('home', 'HomeController@index');
	
	Route::controllers([
		'auth' => 'Auth\AuthController',
		'password' => 'Auth\PasswordController',
	]);
	
	Route::get('/login', 'LoginController@login');
	