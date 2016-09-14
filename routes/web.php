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
                  return Redirect::route('orders.index');
            } else {
                  return view('landing');
            }
      });

      Route::group(['middleware' => ['auth']], function () {

            // Register controllers to models.
            Route::resource('customers', 'CustomerController');
            Route::resource('orders', 'OrderController');

            // A route to display a list of outstanding orders.
            Route::get('customer/{id}/orders', 'CustomerController@getOutstandingOrders')->name('customer.orders');

            // A route for customer to add new cards.
            Route::post('customer/{id}/card/add', 'CustomerController@addNewCard')->name('customer.addcard'); 
            // A route to delete a card.
            Route::delete('customer/{id}/card/delete', 'CustomerController@deleteCard')->name('customer.deletecard'); 
      });
});
