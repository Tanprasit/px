@extends('layouts.master')

@section('css')
      <link rel="stylesheet" href="/css/dashboard.css">
@endsection

@section('body')
      <div class="container-fluid">
            <div class="row">
                  <div class="col-sm-3 col-md-2 sidebar">
                        <ul class="nav nav-sidebar">
                              <li class="active">
                                    <a data-toggle="tooltip" data-placement="bottom" title="View available services" href="{{ route('orders.index') }}">
                                          Services<span class="sr-only">(current)</span>
                                    </a>
                              </li>
                              <li>
                                    <a data-toggle="tooltip" data-placement="bottom" title="Review & modify your recent orders" href="{{ route('customer.orders', [ Auth::user()->id ]) }}">
                                          Orders
                                    </a>
                              </li>
                              <li>
                                    <a data-toggle="tooltip" data-placement="bottom" title="Update your account settings" href="{{ route('customers.edit', [ Auth::user()->id ]) }}">
                                          Settings
                                    </a>
                              </li>
                        </ul>
                  </div>
                  
                  <!-- Table that breaks down the order -->
                  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                        @if(\Session::has('errors'))
                              <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <p>{!! \Session::get('errors') !!}</p>
                              </div>
                        @endif
                        <h1 class="page-header">Checkout</h1>
                        <table class="table table-hover">
                              <thead>
                                    <tr>
                                          <th>Service</th>
                                          <th>Price</th>
                                          <th>Quantity</th>
                                          <th>Total</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    @foreach($orders as $order)
                                          <tr>
                                                <td>{{ $order->name }} <small>({{ $order->description }})</small></td>
                                                <td>£{{ $order->price }}</td>
                                                <td>{{ $quantities[$loop->index] }}</td>
                                                <td>£{{ $totals[$loop->index] }}</td>
                                          </tr>
                                    @endforeach
                              </tbody>
                        </table>
                        <div class="row">
                              <!-- Pick-up/ Drop-off address selection -->
                              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <h3 class="sub-header">Address</h3>
                                    @if($address = Auth::user()->getPrimaryAddress())
                                          <p>{{ $address->address_line_1 }}</p>
                                          <p>{{ $address->address_line_2 }}</p>
                                          <p>{{ $address->town_city }}</p>
                                          <p>{{ $address->county }}</p>
                                          <p>{{ $address->postcode }}</p>
                                    @else
                                          <a class="btn btn-primary" href="{{ route('customers.edit', [Auth::user()->id]) }}"> Add Address</a>
                                    @endif
                              </div>

                              <!-- Card information -->
                              <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                     <h3 class="sub-header">Payment method</h3>
                                     @if($card = Auth::user()->getPrimaryCard())
                                           <p>{{ $card->type }} ending in {{ $card->getLastDigits() }}</p>
                                           <p>{{ $card->name }}</p>
                                           <p>{{ $card->getExpireDate() }}</p>
                                     @else
                                           <a class="btn btn-primary" href="{{ route('customers.edit', [Auth::user()->id]) }}"> Add Card</a>
                                     @endif
                              </div>

                              <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                    <h3 class="sub-header">Order Summary</h3>
                                    <a class="btn btn-warning" href="{{ route('customer.makeorder', [Auth::user()->id]) }}">Proceed To Payment</a>
                              </div>
                        </div>
                  </div>

            </div>
      </div>
@endsection

@section('script')
      <script type="text/javascript">
            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })
      </script>
@endsection