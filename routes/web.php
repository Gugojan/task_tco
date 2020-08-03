<?php

use Illuminate\Support\Facades\Route;


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
Route::resource('/assignment', 'AssignmentsController')->middleware('menager');
Route::resource('/dev', 'DeveloperController')->middleware('developer');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/featch/{status}/{id}', 'DeveloperController@featch')->middleware('developer');
