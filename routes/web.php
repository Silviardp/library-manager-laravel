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

Route::get('/books', 'BookController@index')->name('index');
Route::get('/books/export-csv', 'BookController@export_csv')->name('export-csv');
Route::get('/books/export-xml', 'BookController@export_xml')->name('export-xml');

Route::post('/book', 'BookController@store')->name('store');
Route::delete('/book/{book}', 'BookController@destroy')->name('destroy');
Route::get('/books/{book}/edit', 'BookController@edit')->name('update');
Route::patch('/books/{book}', 'BookController@update')->name('update');

Route::get('/home', 'HomeController@index')->name('home');

