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

Route::redirect('/', '/p', 301);

Route::get('p', 'PlaceController@index');
Route::get('p/{prefecture}', 'PlaceController@districts');
Route::get('p/{prefecture}/{district}', 'PlaceController@shops');
Route::get('p/{prefecture}/{district}/{id}', 'PlaceController@shop');

