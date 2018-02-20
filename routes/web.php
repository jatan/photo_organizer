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

// Home Routs
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@processForm')->name('formSubmit');

// Ajax Routes
Route::post('/calculate','HomeController@calculate')->name('calculate');