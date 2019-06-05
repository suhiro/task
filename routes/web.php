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

Route::get('/','PublicController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/upload','UploadController@index')->name('upload');
Route::post('/upload','UploadController@upload')->name('upload.file');

Route::get('device/tree','DeviceController@index')->name('device.tree');
Route::get('devices/sync','DeviceController@sync')->name('device.sync');