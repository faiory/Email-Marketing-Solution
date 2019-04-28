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
    
    //USERS
    Route::get('users', 'UserController@index')->name('users');
    Route::post('users', 'UserController@store');
    Route::get('users/{id}/{email}/{role}', 'UserController@update');
    Route::get('users/delete/{id}', 'UserController@delete');

    //NEWSLETTERS
    Route::get('newsletters', 'NewsletterController@index')->name('newsletters');
    Route::post('newsletters', 'NewsletterController@store');
    Route::get('newsletters/delete/{id}', 'NewsletterController@delete');

    //CLIENTS
    Route::get('clients', 'ClientController@index')->name('clients');
    Route::post('clients', 'ClientController@store');

    // Route::get('clients', function () {
    //     return view('clients');
    // })->name("clients");

    // SUBSCRIPTION CONTROLLER
    Route::get('unsubscribe ', function () {
        return view('unsubscribe');
    })->name("unsubscribe");



    Route::get('test', function () {
        return view('test');
    })->name("test");

});
Route::get('unsubscribe/{id}', 'SubscriptionController@unsubscribe');

Route::get('createNew', 'UserController@createNew')->name('createNew');


Auth::routes();

// Route::get('test', 'TestController@index');

// Route::get('ID/{id}',function($id) {
//     echo 'ID: '.$id;
// });
