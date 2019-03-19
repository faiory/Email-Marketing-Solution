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
// Route::get('login', function () {
//     return view('login');
// });

Route::get('login', array('uses' => 'HomeController@showLogin'));
Route::post('login', array('uses' => 'HomeController@doLogin'));


// Route::get('ID/{id}',function($id) {
//     echo 'ID: '.$id;
// });

Route::get('/', 'HomeController@index');

Route::get('admin', function () {
    return view('admin_template');
})->name("admin");

Route::get('dashboard', function () {
    return view('dashboard');
})->name("dashboard");

Route::get('users', function () {
    return view('users');
})->name("users");

Route::get('test', 'TestController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');