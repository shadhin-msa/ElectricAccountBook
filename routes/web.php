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


Route::group( ['middleware' => [ 'auth'] ], function () {

	Route::get('/home', 'HomeController@index')->name('home');

	Route::resource('category','CategoryController');
	Route::resource('delar','DelarController');
	Route::resource('product','ProductController');
	Route::resource('area','AreaController');
	Route::resource('customer','CustomerController');
	Route::resource('area-manager','AreaManagerController');
	Route::resource('stock','StockController');
	Route::resource('payment','PaymentController');

	Route::get('/invoice/{invoice}/chalan', 'InvoiceController@chalan')->name('invoice.chalan');
	Route::resource('invoice','InvoiceController');

});
