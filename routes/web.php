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
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('layout');
})->middleware('checkAdmin')->name('home');

Route::middleware('checkLogin')->group(function () {
    Route::get('list-member', 'MemberController@index')->name('member.list');
    Route::get('add-member', 'MemberController@create')->name('member.add');
    Route::post('post-member', 'MemberController@store')->name('member.post');
    Route::get('edit-member/{id}', 'MemberController@edit')->name('member.edit');
    Route::put('update-member/{id}', 'MemberController@update')->name('member.update');
    Route::delete('delte-member/{id}', 'MemberController@delete')->name('member.delete');
    Route::get('show-member/{id}', 'MemberController@show')->name('member.show');

    Route::get('list-department', 'DepartmentController@index')->name('department.list');
    Route::get('add-department', 'DepartmentController@create')->name('department.add');
    Route::post('post-department', 'DepartmentController@store')->name('department.post');
    Route::get('edit-department/{id}', 'DepartmentController@edit')->name('department.edit');
    Route::put('update-department/{id}', 'DepartmentController@update')->name('department.update');
    Route::delete('delte-department/{id}', 'DepartmentController@delete')->name('department.delete');

    Route::get('list-group', 'GroupController@index')->name('group.list');
    Route::get('add-group', 'GroupController@create')->name('group.add');
    Route::post('post-group', 'GroupController@store')->name('group.post');
    Route::get('edit-group/{id}', 'GroupController@edit')->name('group.edit');
    Route::put('update-group/{id}', 'GroupController@update')->name('group.update');
    Route::delete('delte-group/{id}', 'GroupController@delete')->name('group.delete');

    Route::get('profile', 'ProfileController@edit')->name('profile.edit');
    // Route::store('post-profile', 'ProfileController@store')->name('profile.post');
});



Route::get('login', 'LoginController@login')->name('login');
Route::post('checklogin', 'LoginController@checklogin')->name('checklogin');
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');
