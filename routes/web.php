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
    return redirect('/staff');
});

Route::get('/staffs','App\Http\Controllers\StaffsController@index')->name('staff.list'); // 社員一覧画面
Route::get('/staff/{id}','App\Http\Controllers\StaffsController@show')->name('staff.show'); // 社員情報画面

Route::get('/staff','App\Http\Controllers\StaffsController@create')->name('staff.new'); // 新規登録画面
Route::post('/staff/new','App\Http\Controllers\StaffsController@store')->name('staff.store'); // 新規登録処理

Route::get('/staff/edit/{id}','App\Http\Controllers\StaffsController@edit')->name('staff.edit'); // 更新画面
Route::post('/staff/update/{id}','App\Http\Controllers\StaffsController@update')->name('staff.update'); // 更新処理

Route::delete('/staff/{id}','App\Http\Controllers\StaffsController@destroy')->name('staff.destroy'); // 削除画面

Route::get('/result','App\Http\Controllers\StaffsController@result')->name('staff.result'); // 結果画面
Route::get('/error','App\Http\Controllers\StaffsController@error')->name('staff.error'); // エラー画面