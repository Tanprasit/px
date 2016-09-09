<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

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

        return view('customer.index', compact('customers');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Show a form to register a new customer
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'full_name' => 'required',
            'email' => 'required|unique:user',
            'password' => 'required',
            'contact_number' => 'required'
        ]);

        $newCustomer = new Customer();

        $newCustomer->full_name = $request->input('full_name');
        $newCustomer->password = bcrypt($request->input('password'));
        $newCustomer->email = $request->input('email');
        $newCustomer->contact_number = $request->input('contact_nummber');

        $newCustomer->save();

        // Once registered redirect the user to their profile page.
        return Redirect::route('customer.show', [$newCustomer->id]);
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

        return view('customer.show', compact('customer'));
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

        return view('customer.edit', compact('customer'));
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
        return Redirect::route('customer.show', [$customer->id]);
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

        // Once updated redirect the user to their profile page.
        return Redirect::route('login');
    }
}
