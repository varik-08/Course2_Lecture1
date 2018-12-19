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
Auth::routes();

Route::get('/', 'UserController@index');
Route::post('/create-order','UserController@CreateOrder')->name('CreateOrder');
Route::get('/orders', 'AdminController@Orders')->name('GetOrders')->middleware('auth');
Route::get('/products', 'AdminController@Products')->name('GetProducts')->middleware('auth');
Route::post('/products', 'AdminController@CreateProduct')->name('CreateProduct')->middleware('auth');
Route::get('/product/delete/{id}', 'AdminController@DeleteProduct')->name('DeleteProduct')->middleware('auth');
Route::get('/product/restore/{id}', 'AdminController@RestoreProduct')->name('RestoreProduct')->middleware('auth');
