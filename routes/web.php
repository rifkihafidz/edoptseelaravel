<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('/dashboard/adoptdata', 'AdminController@adoptdata')->name('admin.adoptdata');
    Route::get('/dashboard/applicationdata', 'AdminController@applicationdata')->name('admin.applicationdata');
    Route::get('/dashboard/postingdata', 'AdminController@postingdata')->name('admin.postingdata');
    Route::get('/dashboard/postingdata/edit/{id}', 'AdminController@postingdataedit')->name('admin.posting.edit');
    Route::post('/dashboard/postingdata/edit/{id}', 'AdminController@postingdataupdate')->name('admin.posting.update');
    Route::delete('/dashboard/postingdata/delete/{id}', 'AdminController@postingdatadestroy')->name('admin.posting.delete');
    Route::get('/dashboard/userdata', 'AdminController@userdata')->name('admin.userdata');
    Route::get('/dashboard/userdata/edit/{id}', 'AdminController@userdataedit')->name('admin.user.edit');
    Route::post('/dashboard/userdata/edit/{id}', 'AdminController@userdataupdate')->name('admin.user.update');
    Route::delete('/dashboard/userdata/delete/{id}', 'AdminController@userdatadestroy')->name('admin.user.delete');
});

Route::get('/', 'UserController@index')->name('index');
Route::get('/adopt', 'AdoptController@index')->name('adopt');
Route::post('/adopt', 'AdoptController@filters')->name('filterpost');
Route::post('/getAllCities', 'AdoptController@getAllCities');
Route::post('/getCities', 'AdoptController@getCities');
Route::get('details/{id}', 'AdoptController@details')->name('details');
Route::post('details/{id}', 'AdoptController@applyform')->name('applyform');
Route::post('accept-application', 'AdoptController@acceptapply')->name('accept.application');
Route::post('reject-application', 'AdoptController@rejectapply')->name('reject.application');
Route::post('set-adopter', 'AdoptController@setadopter')->name('set.adopter');
Route::get('/posting', 'PostingController@index')->name('posting');
Route::post('/posting', 'PostingController@store')->name('posting.store');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::post('/profile', 'ProfileController@update')->name('profile.update');
Route::get('/profile/details/{id}', 'ProfileController@details')->name('otherprofile');
Route::get('/posting/edit/{id}', 'PostingController@postingedit')->name('posting.edit');
Route::post('/posting/edit/{id}', 'PostingController@postingupdate')->name('posting.update');
Route::delete('/posting/delete/{id}', 'PostingController@destroy')->name('posting.delete');
Auth::routes();
