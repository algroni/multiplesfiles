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
/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    Session::flush();
    return view('home');
});

Route::get('register', 'RegisterController@uploadFiles')->name('register.page');
Route::post('register', 'RegisterController@save')->name('register.save');

Route::get('login', 'LoginController@uploadFiles')->name('login.page');
Route::post('login', 'LoginController@start')->name('login.start');

Route::get('account', 'AccountController@uploadFiles')->name('account.page');
Route::post('account', 'AccountController@save')->name('account.upload');

Route::get('dashboard', 'DashboardController@uploadFiles')->name('dashboard.page');
Route::post('dashboard', 'DashboardController@create')->name('dashboard.create');

Route::get('layers', 'FileController@uploadFiles')->name('files.page');
//Route::get('layers', 'FileController@validateVoucher')->name('files.validateVoucher');
Route::post('layers', 'FileController@storeFiles')->name('files.store');

Route::get('preview', 'PreviewController@uploadFiles')->name('preview.page');
Route::post('preview', 'PreviewController@viewFiles')->name('preview.view');

Route::get('parameters', 'ParameterController@uploadFiles')->name('parameters.store');
Route::post('run', 'ParameterController@runFile')->name('parameters.run');
