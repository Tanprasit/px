<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Route::get('/', function () {
    return view('landing');
});

// Setup routes for login and registration

// To display the forms
Route::get('/sign-in', function () {
      return view('auth.login');
})->name('login');

Route::get('/register', function () {
      return view('auth.register');
})->name('register');

// Register controllers to models
Route::resource('customers', 'CustomerController');