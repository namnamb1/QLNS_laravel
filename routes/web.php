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

use App\Http\Controllers\MemberController;

Route::get('/', function () {
    return view('layout');
});

Route::get('add-member','MemberController@create')->name('member.add');

Route::get('list-department','DepartmentController@create')->name('department.list');
Route::get('add-department','DepartmentController@create')->name('department.add');
Route::post('post-department','DepartmentController@store')->name('department.post');
Route::get('edit-department/{id}','DepartmentController@edit')->name('department.edit');
Route::put('update-department/{id}','DepartmentController@update')->name('department.update');