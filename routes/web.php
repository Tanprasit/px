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
            // Check if customer is logged in.
            if (Auth::check()) {
                  // If redirect to the orders pages
                  return Redirect::route('orders.index');
            } else {
                  // Orderwise take them to the landing page.
                  return view('landing');
            }
      });

      Route::group(['middleware' => ['auth']], function () {

            // Register controllers to models.
            Route::resource('orders', 'OrderController');
            Route::resource('customers', 'CustomerController');
            Route::resource('addresses', 'AddressController');

            // A route to display a list of outstanding orders.
            Route::get('customers/{customer}/orders', 'CustomerController@getOrders')->name('customer.orders');

            // A route for customer to add new cards.
            Route::post('customers/{customer}/card/add', 'CustomerController@addNewCard')->name('customer.addcard'); 
            // A route to delete a card
            Route::delete('customers/{customer}/card/delete', 'CustomerController@deleteCard')->name('customer.deletecard'); 

            // A route for customer to add new order to their cart.
            Route::post('customers/{customer}/cart/add/order/{order}', 'CustomerController@addToCart')->name('customer.addtocart');
           // A route for customer to remove an order from their cart.
            Route::get('customers/{customer}/cart/remove/order/{order}', 'CustomerController@removeFromCart')->name('customer.removefromcart');
            // A route for customer to update an order within their cart
            Route::get('customers/{customer}/cart/edit/order/{order}', 'CustomerController@editFromCart')->name('customer.editfromcart');;

            // A route for customer to make an address a primary.
            Route::post('customers/{customer}/address/{address}/make/primary', 'CustomerController@makePrimaryAddress')->name('address.makeprimary');
            // A route for customer to change their primary address.
            Route::post('customers/{customer}/card/{card}/make/primary', 'CustomerController@makePrimaryCard')->name('card.makeprimary');

            // A route for customer to make an order and take payment.
            Route::get('csutomers/{customer}/make/order', 'CustomerController@makeOrder')->name('customer.makeorder');

      });
});
