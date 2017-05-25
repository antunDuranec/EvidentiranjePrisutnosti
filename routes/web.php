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

Route::get('/', function () {
    return view('layouts.welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('kolegij/{id}','KolegijController@show');

Route::get('admin/profesor-kolegij/create','KolegijController@create1');
Route::get('admin/profesor-kolegij','KolegijController@index1');
Route::post('admin/profesor-kolegij','KolegijController@store1');
Route::delete('admin/profesor-kolegij/{id}','KolegijController@destroy1');

Route::get('korisnik/{id}/edit-password','UsersController@edit_password');
Route::post('korisnik/{id}/edit-password','UsersController@update_password');
Route::get('admin','UsersController@indexAdmin');

Route::resource('admin/kolegij', 'KolegijController');
Route::resource('admin/razina-prava', 'RazinaPravaController');
Route::resource('admin/korisnik', 'UsersController',['except' => ['destroy']]);
Route::resource('korisnik', 'UsersController',['except' => ['destroy']]);
Route::resource('admin/student-kolegij', 'StudentNaKolegijuController',['except' => ['update','edit']]);
Route::resource('termin', 'TerminController',['except' => ['update','edit']]);
Route::delete('korisnik/{id}','UsersController@destroy1');


Route::get('prijava-prisutnosti', 'EvidencijaController@index');
Route::post('prijava-prisutnosti','EvidencijaController@store');
Route::get('moja-prisutnost', 'EvidencijaController@indexPrisutnost');

Route::get('student-kolegij', 'StudentNaKolegijuController@index1');

