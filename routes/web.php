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
//     return view('home');
// });

Route::get('/index.html', 'Controller@index');

Route::get('/', 'Controller@index');

Route::post('/db', 'Controller@getDB');

Route::any('{all}', function () {
    return view('home');})->where(['all' => '.*']);