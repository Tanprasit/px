@extends('layouts.master')

@section('css')
      <link rel="stylesheet" href="/css/dashboard.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
@endsection

@section('body')
      <div class="container-fluid">
            <div class="row">
                  <div class="col-sm-3 col-md-2 sidebar">
                        <ul class="nav nav-sidebar">
                              <li>
                                    <a data-toggle="tooltip" data-placement="bottom" title="View available services" href="{{ route('dashboard') }}">
                                          Services
                                    </a>
                              </li>
                              <li>
                                    <a data-toggle="tooltip" data-placement="bottom" title="Review & modify your recent orders" href="{{ route('customer.orders', [ Auth::user()->id]) }}">
                                          Orders
                                    </a>
                              </li>
                              <li class="active">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Update your account settings" href="{{ route('customers.edit', [ Auth::user()->id ]) }}">
                                          Settings<span class="sr-only">(current)</span>
                                    </a>
                              </li>
                        </ul>
                  </div>

                  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                        <h1 class="page-header">Your Details</h1>
                        <div class="row">
                              <!-- Form to update the user's details -->
                              <form class="form-horizontal" action="{{ route('customers.update', [ Auth::user()->id ]) }}" method="POST" role="form">
                                {{ csrf_field() }}
                                <!-- Needed direct to the correct route and controller -->
                                {{ method_field('PUT') }}
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Full Name</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="full_name" value="{{ $customer->full_name }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $customer->email }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}} password-form">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} password-form">
                                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Add contact number form -->
                                <div class="form-group{{ $errors->has('contact_number') ? ' has-error' : '' }}">
                                    <label for="contact-number" class="col-md-4 control-label">Contact Number</label>

                                    <div class="col-md-6">
                                        <input id="contact-number" type="text" class="form-control" name="contact_number" value="{{ $customer->contact_number }}" required>

                                        @if ($errors->has('contact-number'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('contact-number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button id="submit-button" type="submit" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                                </div>
                              </form>
                        </div>
                        <br>

                        <!-- Table display all cards linked with current user -->
                        <h2 class="sub-header">
                              My Payment Details           
                              <btn class="btn btn-primary pull-right" data-toggle="modal" data-target="#addCard">
                                    Add Card
                              </btn>
                        </h2>
                        <table id="payment-table" class="display" cellspacing="0" width="100%">
                              <thead>
                                    <tr>
                                          <th>
                                            Card Number
                                          </th>
                                          <th>
                                            Card Type
                                          </th>
                                          <th>
                                            Expire Date
                                          </th>
                                          <th></th>
                                    </tr>
                              </thead>
                              <tbody>
                                    @foreach($customer->cards()->get() as $card)
                                          <tr>
                                                <td>{{ $card->getMaskedCardNumber() }}</td>
                                                <td>{{ $card->type }}</td>
                                                <td>{{ $card->getExpireDate() }}</td>
                                                <!-- Delete button -->
                                                <td>
                                                  <form method="POST" action="{{ route('customer.deletecard', [Auth::user()->id]) }}">
                                                      {{ method_field('DELETE') }}
                                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                      <input type="hidden" name="card_id" value={{ $card->id }}>
                                                      <button class="btn btn-danger" type="submit">Delete</button>
                                                  </form>
                                                </td>
                                          </tr>
                                    @endforeach
                              </tbody>
                        </table>
                  </div>
                  @include('widgets.modal.addcard')
            </div>
      </div>
@endsection

@section('script')
      <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
      <script>
        $(function () {
          
          $('[data-toggle="tooltip"]').tooltip();
          $('#payment-table').DataTable({
            "scrollX": true
          });
        });
      </script>
@endsection