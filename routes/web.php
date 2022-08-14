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
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Auth;
use App\Cities;

Route::middleware('checkLogin')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('list-member', 'MemberController@index')->name('member.list');
    Route::get('resetkeyword', 'MemberController@resetKeyword')->name('member.reset');
    Route::get('add-member', 'MemberController@create')->name('member.add')->middleware('checkAdmin:admin');
    Route::post('post-member', 'MemberController@store')->name('member.post')->middleware('checkAdmin:admin');
    Route::get('edit-member/{id}', 'MemberController@edit')->name('member.edit')->middleware('checkAdmin:admin');
    Route::put('update-member/{id}', 'MemberController@update')->name('member.update')->middleware('checkAdmin:admin');
    Route::delete('delte-member/{id}', 'MemberController@delete')->name('member.delete')->middleware('checkAdmin:admin');
    Route::get('show-member/{id}', 'MemberController@show')->name('member.show');

    Route::get('list-department', 'DepartmentController@index')->name('department.list');
    Route::get('add-department', 'DepartmentController@create')->name('department.add')->middleware('checkAdmin:admin');
    Route::post('post-department', 'DepartmentController@store')->name('department.post')->middleware('checkAdmin:admin');
    Route::get('edit-department/{id}', 'DepartmentController@edit')->name('department.edit')->middleware('checkAdmin:admin');
    Route::put('update-department/{id}', 'DepartmentController@update')->name('department.update')->middleware('checkAdmin:admin');
    Route::delete('delte-department/{id}', 'DepartmentController@delete')->name('department.delete')->middleware('checkAdmin:admin');

    Route::get('list-group', 'GroupController@index')->name('group.list');
    Route::get('add-group', 'GroupController@create')->name('group.add')->middleware('checkAdmin:admin');
    Route::post('post-group', 'GroupController@store')->name('group.post')->middleware('checkAdmin:admin');
    Route::get('edit-group/{id}', 'GroupController@edit')->name('group.edit')->middleware('checkAdmin:admin');
    Route::put('update-group/{id}', 'GroupController@update')->name('group.update')->middleware('checkAdmin:admin');
    Route::delete('delte-group/{id}', 'GroupController@delete')->name('group.delete')->middleware('checkAdmin:admin');

    Route::get('profile', 'ProfileController@create')->name('profile.add');
    Route::get('show-request/{id}', 'ProfileController@show')->name('profile.show')->middleware('checkAdmin:admin');
    Route::get('list-request', 'ProfileController@index')->name('profile.list')->middleware('checkAdmin:admin');
    Route::post('post-profile', 'ProfileController@store')->name('profile.post');
    Route::put('update-profile/{id}', 'ProfileController@update')->name('profile.update')->middleware('checkAdmin:admin');
    Route::delete('delte-profile/{id}', 'ProfileController@delete')->name('profile.delete')->middleware('checkAdmin:admin');

    Route::get('reset-password', 'ProfileController@getReset')->name('password.index');
    Route::post('reset-password', 'ProfileController@changePassWord')->name('password.post');

    Route::get('district', 'AdressController@getDistricts')->name('ajax.address.districts');
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
