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

Route::get('/', 'Controller@index')->middleware('verify');

Route::post('/userLogin', 'Controller@userLogin');

Route::get('/userLogout', 'Controller@userLogout');

Route::post('/userRegistration', 'Controller@userRegistration');

Route::post('/db', 'Controller@getDB');

Route::post('/sendRequest', 'Controller@sendRequest');

Route::post('/getRequests', 'Controller@getRequests');

Route::get('/getAllOngoingRequests', 'Controller@getAllOngoingRequests');

Route::post('/fixRequest', 'Controller@fixRequest');

Route::post('/appLogin', 'Controller@appLogin');

Route::any('{all}', function () {
    return view('home');})->where(['all' => '.*']);