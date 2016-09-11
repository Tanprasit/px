<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Validator;

use App\Http\Requests;
use App\Customer;

class CustomerController extends Controller
{
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

        return view('customes.edit', compact('customer'));
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
            'email' => 'required|unique:user',
            'password' => 'required',
            'contact_number' => 'required'
        ]);

        $customer = Customer::findOrFail($id);

        $customer->full_name = $request->input('full_name');
        $customer->password = bcrypt($request->input('password'));
        $customer->email = $request->input('email');
        $customer->contact_number = $request->input('contact_nummber');

        $customer->save();

        // Once updated redirect the user to their profile page.
        return Redirect::route('customers.show', [$customer->id]);
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
}
