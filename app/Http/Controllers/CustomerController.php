<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Validator;

use App\Http\Requests;
use App\Customer;
use App\Card;
use App\Order;
use App\Address;

use Auth;
use Carbon\Carbon;

class CustomerController extends Controller
{   

    public function __construct() {

        // Prevent users from modifying resources of other users.
        $this->middleware('account.owner',
            [ 'only' => [ 'edit', 'update', 'customer.addcard', 'customer.addcard' ] ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the customers.
        $customers = Customer::all();

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // Show a form to register a new customer
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'full_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:customers',
            'password' => 'required|min:6|confirmed',
            'contact_number' => 'required|max:15'
        ]);

        // Checks if the two passwords entered by the customer matches
        $validator->after(function($validator) use ($request) {
            $password = $request->input('password');
            $passwordConfirmation = $request->input('password_confirmation');

            if ($password != $passwordConfirmation) {
                 $validator->errors()->add('password', 'The passwords entered did not match.');
                 $validator->errors()->add('password_confirmation', 'The passwords entered did not match.');
            }
        });

        // If the valdation fails send an error message back along with the input.
        if ($validator->fails()) {
            return redirect('/register')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Otherwise make a new customer with the supplied data.
        $newCustomer = new Customer();  
        $newCustomer->full_name = $request->input('full_name');
        $newCustomer->password = bcrypt($request->input('password'));
        $newCustomer->email = $request->input('email');
        $newCustomer->contact_number = $request->input('contact_number');
        $newCustomer->save();

        // Once registered redirect the user to their profile page.
        return Redirect::route('customers.show', [$newCustomer->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Given the id show the correc customer profile
        $customer = Customer::findOrFail($id);

        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get customer information to display it in a form
        $customer = Customer::findOrFail($id);

        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'full_name' => 'required',
            'email' => 'required|unique:customers,email,' . $id,
            'password' => '',
            'contact_number' => 'required'
        ]);

        $customer = Customer::findOrFail($id);

        $customer->full_name = $request->input('full_name');
        $customer->password = bcrypt($request->input('password'));
        $customer->email = $request->input('email');
        $customer->contact_number = $request->input('contact_number');

        $customer->save();

        // Once updated redirect the user to their profile page.
        return Redirect::route('customers.edit', [$customer->id])
            ->with('message', 'Your account information was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $customer = Customer::findOrFail($id);

        $customer->delete();

        // Once deleted redirect to login page.
        return Redirect::route('login');
    }

    //  Get a list of outstanding orders belong to a user
    public function getOrders($id) {
        $customer = Customer::findOrFail($id);
        $outstandingOrders = $customer->orders()->where('completed' , false)->get();
        $completedOrders = $customer->orders()->where('completed', true)->get();

        return view('customers.orders', compact('outstandingOrders', 'completedOrders'));
    }

    public function addNewCard(Request $request, $id) {
        $nameOnCard = $request->input('name_on_card');
        $number = $request->input('number');
        $expireMonth = $request->input('expiry_month');
        $expireYear = $request->input('expiry_year');

        // Check if this is the user's first address if so set it
        // as primary address.
        $primary = (!count(Auth::user()->cards()->get()))
                        ? true 
                        : false;

        $newCard = new Card();
        $newCard->name_on_card = $nameOnCard;
        $newCard->customer_id = $id;
        $newCard->number = $number;
        // Generate a card type ie. mastercard, visa using the number provided
        $newCard->type = CardController::cardType($number);
        $newCard->expires = $this->getCarbonTime($expireYear, $expireMonth, 1)->toDateTimeString();
        $newCard->primary = $primary;
        $newCard->save();

        return Redirect::back();
    }

    public function deleteCard(Request $request) {
        $cardId = $request->input('card_id');
        $card = Card::findOrFail($cardId);
        $card->delete();

        return Redirect::back();
    }


    // Calculate the total cost with discount and display it as a checkout page
    public function addToCart(Request $request, Customer $customer, $orderId) {
        // Grab item information from cart.
        $quantity = $request->input('quantity');
        $name = $request->input('name');

        // Check if the cart exists in the session, if so grab it
        // otherwise create a new array to store the products.
        $products = ($request->session()->has('cart'))
            ? $request->session()->get('cart')
            : [] ;

        // Store the products in the session
        $products[$orderId] = $quantity;
        $request->session()->put('cart', $products);

        $response = ($quantity > 1)
            ? $quantity . ' ' . $name . ' items were added to the cart.'
            : $quantity . ' ' . $name . ' item was added to the card.';

        // Add item to session basket
        return Redirect::back()
            ->with('message', $response);
    }

    public function removeFromCart(Request $request, $customerId, $orderId) {
        // Grab item information from cart.
        $products = $request->session()->get('cart');

        // remove item from cart.
        unset($products[$orderId]);
        $request->session()->put('cart', $products);

        // Check if th cart is now empty if so direct the user back to the orders page
        // With a message informing them that the cart is empty.
        if (!$products) {
            return Redirect::route('orders.index')
                ->with('message', 'The cart is now empty!');
        } else {
            // Store the updated in the session
            return Redirect::back()
                ->with('message', 'An item was removed from your cart!');;
        }
    }

    public function editFromCart(Request $request, $customerId, $orderId) {
        // Grab item information from form.
        $products = $request->session()->get('cart');
        $quantity = $request->input('quantity');

        $products[$orderId] = $quantity;

        // Store the products in the session
        $request->session()->put('cart', $products);

        // Add item to session basket
        return Redirect::back();
    }

    // Make orders using the session and proceed with stripe
    public function makeOrder(Request $request) {
        $errorMessage = "";
        // Check if user has a primary address.
        if (!Auth::user()->getPrimaryAddress()) {
            $errorMessage .= 'You need to add an address! ';
        }

        // Check if user has a primary card.
        if (!Auth::user()->getPrimaryCard()) {
            $errorMessage .= 'You need to add a card! ';
        }

        // If there are error message break out now with the error message
        if ($errorMessage) {
            return Redirect::back()
                ->with('errors',   $errorMessage);
        }

        // If cart is not null, grab all order ids
        if ($orders = $request->session()->get('cart')) {
            foreach ($orders as $orderId => $quantity) {
                // For each order get the order object
                $order = Order::findOrFail($orderId);
                Auth::user()->orders()->attach($order->id, [
                    'quantity' => $quantity,
                    'discount_amount' => 0.00,
                    'order_date' => Carbon::now()->toDateTimeString(),
                    'delivery_date' => Carbon::now()->addDays(7)->toDateTimeString(),
                    'completed' => false,
                ]);
            }
        }

        // Empty the cart.
        $request->session()->forget('cart');

        // Make a customer order and save it to the database
        return Redirect::route('customer.orders', [Auth::user()->id])
            ->with('message', 'Success, thank you for make an order!');
    }

    public function makePrimaryAddress(Request $request, $customerId, $primarAddressId) {
        // Get current primary address
        $customer = Customer::findOrFail($customerId);
        $primaryAddress = $customer->getPrimaryAddress();
        // Make it no longer the primary address
        $primaryAddress->primary = false;
        $primaryAddress->save();
        // Get the address that we want to make primary
        // Set it to primary
        $newPrimaryAddress = Address::findOrFail($primarAddressId);
        $newPrimaryAddress->primary = true;
        $addressLineOne = $newPrimaryAddress->address_line_1;
        $newPrimaryAddress->save();

        return Redirect::back()
            ->with('message', $addressLineOne . ' is now your primary address!');
    }

    public function makePrimaryCard(Request $request, $customerId, $primaryCardId) {
        // Get current primary card
        $customer = Customer::findOrFail($customerId);
        // Make it no longer the primary card
        $primaryCard = $customer->getPrimaryCard();
        $primaryCard->primary = false;
        $primaryCard->save();

        // Get the card that we want to make primary
        // Set it to primary
        $newPrimaryCard = Card::findOrFail($primaryCardId);
        $newPrimaryCard->primary = true;
        $lastDigits = $newPrimaryCard->getLastDigits();
        $newPrimaryCard->save();

        return Redirect::back()
            ->with('message', 'Card ending in ' . $lastDigits . ' is now your primary card!');
    }
}
