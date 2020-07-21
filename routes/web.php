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
// ユーザのみ
Route::group(['middleware' => ['auth', 'verified']], function () {
  Route::get('home', 'HomeController@index')->name('home');
  Route::resource('evaluations', 'EvaluationsController');
});

// 店舗のみ
Route::group(['middleware' => ['auth', 'verified', 'can:shop-only']], function () {
  Route::get('home_shop', 'HomeShopController@index')->name('home_shop');
  Route::resource('shops.blogs', 'BlogsController', ['except' => ['index', 'show']]);
  Route::resource('shops', 'ShopsController', ['except' => ['index', 'show']]);
  Route::get('/shops/{shop}/linkage', 'ShopsController@connect');
  Route::post('/shops/{shop}/linkage', 'ShopsController@linkage');
  
});

// 管理者のみ
Route::group(['middleware' => ['auth', 'verified', 'can:admin-only']], function () {
  Route::get('home_admin', 'HomeAdminController@index')->name('home_admin');
});





Route::redirect('/', '/p', 301);

Route::get('p', 'PlaceController@index');
Route::get('p/{prefecture}', 'PlaceController@districts');
Route::get('p/{prefecture}/{district}', 'PlaceController@shops');
Route::get('p/{prefecture}/{district}/{id}', 'PlaceController@shop')->name('shop');
Route::resource('shops', 'ShopsController', ['only' => ['index', 'show']]);

Route::get('shops/{shop}/blogs/{blog}', 'BlogsController@show');



Auth::routes(['verify' => true]);
#Route::view('register_admin', 'auth.register_admin');
Route::view('register_shop', 'auth.register_shop');
Route::post('register_shop', 'Auth\RegisterShopController@register')->name('register_shop');

Route::view('login_shop', 'auth.login_shop');
Route::post('login_shop', 'Auth\LoginShopController@login')->name('login_shop');

Route::view('login_admin', 'auth.login_admin');
Route::post('login_admin', 'Auth\LoginAdminController@login')->name('login_admin');





