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
                        @if(\Session::has('message'))
                              <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <p>{!! \Session::get('message') !!}</p>
                              </div>
                        @endif
                        <h1 class="page-header">Ironing Service <a class="btn btn-primary pull-right" href="{{ route('orders.create') }}">Checkout</a></h1>
                        <div class="row">
                              @foreach($orders as $order)
                                    <form method="POST" action="{{ route('customer.addtocart', [Auth::user()->id, $order->id]) }}">
                                          {{ csrf_field() }}
                                          <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                                                <div class="thumbnail">
                                                      <div class="caption text-center">
                                                            <h3>{{ $order->name }}</h3>
                                                            <small>{{ $order->description }}</small>
                                                            <hr>
                                                            <h4>£{{ $order->price }}</h4>
                                                            <hr>
                                                            <input name="quantity" class="form-control text-center" type="number" value="0">
                                                            <input name="name" type="hidden" value="{{ $order->name  }}">
                                                            <hr>
                                                            <input class="btn btn-primary form-control" type="submit" value="Add">
                                                      </div>
                                                </div>
                                          </div>
                                    </form>
                              @endforeach
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