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
//     return view('welcome');
// });

Route::get('/','CssProjectController@dashboard');
Route::get('reports','Reports@reports');
Route::get('Device','Device@Device');
Route::any('getDevice','Device@getparameters');
Route::get('Alert','Alert@Alert');
Route::get('User','User@User');
Route::post('UpdateAccessToken','User@AccessToken');


Route::get('User-Logout','User@logout');