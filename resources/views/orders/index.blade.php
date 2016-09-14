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

                  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                        <h1 class="page-header">Ironing Service <a class="btn btn-primary pull-right" data-toggle="modal" href="#checkout">Continue</a></h1>
                        <div class="row">
                              @foreach($orders as $order)
                                    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                                          <div class="thumbnail">
                                                <div class="caption text-center">
                                                      <h3>{{ $order->name }}</h3>
                                                      <hr>
                                                      <h4>£{{ $order->price }}</h4>
                                                      <hr>
                                                      <input name="quantity" class="form-control" type="number" value="0">
                                                      <input type="hidden" name="name" value="{{ $order->name }}">
                                                      <input type="hidden" name="price" value="{{ $order->price }}">
                                                </div>
                                          </div>
                                    </div>
                              @endforeach
                        </div>
                  </div>
            </div>
      </div>
      @include('widgets.modal.checkout')
@endsection

@section('script')
      <script type="text/javascript">
            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })
      </script>
      <!-- Script to grab all the user inputs in the fields and calculate the total cost -->
      <!-- ITEM QUANTITY PRICE -->
      <script type="text/javascript">
            function getNameArray() {
                  
            }

            function getQuantityArray() {

            }

            function getPriceArray() {

            }
            
            var nameArray = getNameArray();
            var quantityArray = getQuantityArray();
            var priceArray = getPriceArray();
      </script>
@endsection