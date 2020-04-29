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

// Route::get('/', function () {
//    return view('welcome');
// });

Route::get('/','HomeController@index');
Route::get('/','LayoutController@index');
Route::get('/admin/odevler','OdevController@index');
Route::get('/admin/odev/create','OdevController@create');
Route::post('/admin/odev/store','OdevController@store');
Route::get('/admin/odev/{id}/edit','OdevController@edit');
Route::get('/admin/odev/{id}/benzerlik-karsilastir','OdevController@benzerlikKarsilastir');
Route::post('/admin/odev/{id}/update','OdevController@update');
Route::get('/admin/odev/{id}/destroy','OdevController@destroy');
Route::get('/admin/tablo','OdevController@tabloIndex');
