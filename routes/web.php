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

Route::get('login', array('uses' => 'HomeController@showLogin'));
Route::post('login', array('uses' => 'HomeController@doLogin'));



// TO ACCESS THIS ROUTE GROUP YOU HAVE TO BE AUTHENTICATED
Route::middleware(['auth'])->group(function () {    
    Route::get('/', 'HomeController@index')->name('/');
    Route::get('users', 'UserController@index')->name('users');
    // Route::get('users', 'UserController@index')->name('users');
    
    Route::post('users', 'UserController@store');
    
    // Route::post('users', array('uses' => 'UserController@store'));

    
    Route::get('clients', function () {
        return view('clients');
    })->name("clients");
});

Route::get('createNew', 'UserController@createNew')->name('createNew');


Auth::routes();

// Route::get('test', 'TestController@index');

// Route::get('ID/{id}',function($id) {
//     echo 'ID: '.$id;
// });
