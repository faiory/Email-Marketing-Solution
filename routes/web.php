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
    
    // UTILITY
    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::post('profile', 'ProfileController@changePassword');

    //USERS
    Route::get('users', 'UserController@index')->name('users');
    Route::post('users', 'UserController@store');
    Route::post('users.modify', 'UserController@modify');
    Route::post('users/delete', 'UserController@delete');
    Route::get('users/search', 'UserController@search');

    //NEWSLETTERS
    Route::get('newsletters', 'NewsletterController@index')->name('newsletters');
    Route::post('newsletters', 'NewsletterController@store');
    Route::post('newsletters/modify', 'NewsletterController@modify');
    Route::post('newsletters/delete', 'NewsletterController@delete');
    
    // Route::get('newsletters/delete/{id}', 'NewsletterController@delete');

    //CLIENTS
    Route::get('clients', 'ClientController@index')->name('clients');
    Route::post('clients', 'ClientController@store');
    Route::post('clients/modify', 'ClientController@modify');
    Route::post('clients/delete', 'ClientController@delete');
    Route::post('clients/upload', 'ClientController@upload');
    
    // Route::get('clients/delete/{id}', 'ClientController@delete');
    // Route::get('clients/update/{id}/{email}/', 'ClientController@update');
    Route::get('clients/search', 'ClientController@search');
    
    // SCHEDULES
    Route::get('schedule', 'ScheduleController@index')->name('schedule');
    Route::post('schedule', 'ScheduleController@store');
    Route::post('schedule/modify', 'ScheduleController@modify');
    Route::post('schedule/delete', 'ScheduleController@delete');

    // REPORTS
    Route::get('reports', 'ReportController@index')->name('reports');
    Route::post('reports', 'ReportController@applyDate')->name('reportsPost');

    // SUBGROUPs
    Route::get('subgroups', 'SubgroupController@index')->name('subgroups');
    Route::post('subgroups', 'SubgroupController@modify');
    Route::post('subgroups/delete', 'SubgroupController@delete');

});

// Unsubscribe test WrkvJ2wRDr

Route::get('unsubscribe/{id}', 'SubscriptionController@unsubscribe');
Route::get('createNew', 'UserController@createNew')->name('createNew');
Route::get('newsletter', function () {
    return view('mail.newsletter');
})->name("newsletter");


// Route::post('profile', 'ProfileController@forgotPassword');
Auth::routes();
