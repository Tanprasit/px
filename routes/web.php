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
use Illuminate\Http\RedirectResponse;

// Routes within this group will have access to sessions and  csrf protection.
// Setup routes for login and registration

Route::group(['middleware' => ['web']], function () {      
      Auth::routes();

      Route::get('/', function () {
            if (Auth::check()) {
                  return Redirect::route('dashboard');
            } else {
                  return view('landing');
            }
      });

      Route::group(['middleware' => ['auth']], function () {
            Route::get('/dashboard', function() {
                  return view('dashboard');
            })->name('dashboard');

            // Register controllers to models
            Route::resource('customers', 'CustomerController');
      });
});
