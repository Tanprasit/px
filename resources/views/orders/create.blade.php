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
                        @if(\Session::has('message'))
                              <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <p>{!! \Session::get('message') !!}</p>
                              </div>
                        @endif
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
                                                <td>
                                                  <form class="form-inline" method="POST" action="{{ route('customer.addtocart', [Auth::user()->id, $order->id]) }}">
                                                    {{ csrf_field() }}
                                                    <input class="form-control" type="number" name="quantity" value="{{ $quantities[$loop->index] }}" max="99">
                                                    <input class="btn btn-sm" type="submit" value="Update">
                                                  </form>
                                                </td>
                                                <td>£{{ $subTotal[$loop->index] }} <a href="{{ route('customer.removefromcart', [Auth::user()->id, $order->id]) }}" class="close">&times;</a></td>
                                          </tr>
                                    @endforeach
                              </tbody>
                        </table>
                        <div class="row">
                              <!-- Pick-up/ Drop-off address selection -->
                              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <h3 class="sub-header">Address <small>(<a href="{{ route('customers.edit', [Auth::user()->id]) }}#add-address-section">change</a>)</small></h3>
                                    @if($address = Auth::user()->getPrimaryAddress())
                                          <span>{{ $address->address_line_1 }}</span>
                                          <br>
                                          @if($address->line_2)
                                            <span>{{ $address->address_line_2 }}</span>
                                            <br>
                                          @endif
                                          <span>{{ $address->town_city }}</span>
                                          <br>
                                          <span>{{ $address->county }}</span>
                                          <br>
                                          <span>{{ $address->postcode }}</span>
                                    @else
                                          <a class="btn btn-primary" href="{{ route('customers.edit', [Auth::user()->id]) }}"> Add Address</a>
                                    @endif
                              </div>

                              <!-- Card information -->
                              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                     <h3 class="sub-header">Payment method <small>(<a href="{{ route('customers.edit', [Auth::user()->id]) }}#add-card-section">change</a>)</small></h3>
                                     @if($card = Auth::user()->getPrimaryCard())
                                           <span>{{ $card->type }} ending in <strong>{{ $card->getLastDigits() }}</strong></span>
                                           <span>{{ $card->name }}</span>
                                           <br>
                                           <span>{{ $card->getExpireDate() }}</span>
                                     @else
                                           <a class="btn btn-primary" href="{{ route('customers.edit', [Auth::user()->id]) }}"> Add Card</a>
                                     @endif
                              </div>

                              <div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1">
                                    <h3 class="sub-header">Order Summary</h3>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
                                      <p>Order Total: </p>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
                                      <span class="pull-left text-center">£{{ $orderTotal }}</span>
                                    </div>
                                    <hr>
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